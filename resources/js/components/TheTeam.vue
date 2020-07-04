<template>
    <div class="col-12 p-3">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 text-center">
                    <PlayerAlert :message="messageResponse" :type-alert="typeAlert" :show-alert="showAlert"> </PlayerAlert>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr class="text-center">

                        <th scope="col">Jugador</th>
                        <th scope="col">Posición</th>
                        <th scope="col">Goles</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="player in players" :key="player.id" class="text-center">

                        <td> {{ player.name }} </td>
                        <td> {{ player.position }} </td>
                        <td> {{ player.goals }} </td>
                        <td  class="d-flex flex-wrap justify-content-center">
                            <PlayerGoals @reload_players="getPlayers"  :player="player"></PlayerGoals>
                            <button class="btn btn-primary mx-3" @click="setDataPlayerForUpdateForm(player)" > Editar</button>
                            <button class="btn btn-secondary mx-3" @click="deletePlayer(player.id)"> Eliminar </button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-4 d-flex align-items-center">
                    <div class="col-12">
                        <form action="" class="form" @submit.prevent="saveDataForm">
                            <div class="form-group">
                                <h3>Formulario de Jugadores</h3>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input type="text"
                                       v-model="form.name"
                                       id="name"
                                       :class="[
                                   Object.keys(errors).length > 0 && hasError('name') ? 'is-invalid' : '',
                                   'form-control'
                               ]">
                                <div
                                    :class="Object.keys(errors).length > 0 && hasError('name') ? 'invalid-feedback' : '' "
                                    v-show="Object.keys(errors).length > 0 && hasError('name')"
                                >
                                    {{ getFirstErrors('name') }}
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-7">
                                        <label for="position">Posición: </label>
                                        <input type="text"
                                               v-model="form.position"
                                               id="position"
                                               :class="[
                                        Object.keys(errors).length > 0 && hasError('position') ? 'is-invalid' : '',
                                        'form-control'
                                        ]"
                                        >
                                        <div
                                            :class="Object.keys(errors).length > 0 && hasError('position') ? 'invalid-feedback' : '' "
                                            v-show="Object.keys(errors).length > 0 && hasError('position')"
                                        >
                                            {{ getFirstErrors('position') }}
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label for="goals">Goles: </label>
                                        <input
                                            type="text"
                                            v-model.number="form.goals"
                                            id="goals"
                                            :class="[
                                        Object.keys(errors).length > 0 && hasError('goals') ? 'is-invalid' : '',
                                        'form-control'
                                        ]">
                                        <div
                                            :class="Object.keys(errors).length > 0 && hasError('goals') ? 'invalid-feedback' : '' "
                                            v-show="Object.keys(errors).length > 0 && hasError('goals')"
                                        >
                                            {{ getFirstErrors('goals') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn-primary btn-block"> {{ btnAction }} </button>
                                <button class="btn btn-secondary btn-block my-2" @click.prevent="clear" > Cancelar </button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PlayerGoals  from "./PlayerGoals";
    import PlayerAlert from "./PlayerAlert";
  export default {
    name: "ThePlayer",
    components: {
        PlayerGoals,
        PlayerAlert
    },
    data () {
        return {
            players : [],
            form: {
                name: null,
                position: null,
                goals:  null,
                id: null
            },
            btnAction: 'Guardar',
            errors: {},
            messageResponse : '',
            typeAlert: '',
            showAlert: false,
            alertSuccess : 'alert-success',
            alertDanger : 'alert-danger'

        }
    },
    computed: {
        totalPlayers() {
            return this.players.length;
        }
    },
    methods: {
        getPlayers() {
            axios.get('/players').then( res => {
                this.players = res.data.data
            })
        },
        deletePlayer(id) {
            axios.delete(`/players/${id}`).then(response => {
                this.getPlayers()
                this.prepareShowAlert(response.data.message, this.alertSuccess)
            }).catch(error => {
                this.prepareShowAlert(`No se pudo eliminar el jugador, error: ${error.response.data.message}`, this.alertDanger)
            })
        },
        setDataPlayerForUpdateForm(player) {
          this.form = {
              ...player
          }
          this.btnAction = 'Actualizar'
        },
        saveDataForm() {
          if (this.btnAction === 'Guardar') {
              return this.storeDataPlayer()
          }
          return this.updateDataPlayer()

        },
        storeDataPlayer() {
             return axios.post('/players', {...this.form}).then( response => {
                    this.clear()
                    this.getPlayers()
                    this.prepareShowAlert(response.data.message, this.alertSuccess)
                }).catch(error => {
                    this.errors = error.response.data.errors
                })
        },
        updateDataPlayer() {
          return axios.put(`/players/${this.form.id}`, {...this.form}).then(response => {
              this.clear()
              this.getPlayers()
              this.prepareShowAlert(response.data.message, this.alertSuccess)
          }).catch(error =>  {
              this.errors = error.response.data.errors
          })
        },
        prepareShowAlert(message, typeAlert) {
            this.messageResponse = message
            this.typeAlert = typeAlert
            this.showAlert = true
            this.setTimeoutShowAlert()
        },
        setTimeoutShowAlert() {
            setTimeout(() => {
                this.showAlert = false
            },2000)
        },
        hasError(key) {
          if (typeof this.errors === 'object') {
              return (Object.keys(this.errors)).includes(key)
          }
        },
        getFirstErrors(key) {
            if (typeof this.errors === 'object' && Object.keys(this.errors).length > 0 && this.hasError(key)) {
                return this.errors[key][0]
            }
        },
        clear() {
            this.form.goals = null
            this.form.position = null
            this.form.id = null
            this.form.name = null
            this.btnAction = 'Guardar'
            this.errors = {}
            this.messageResponse = ''
            this.typeAlert = ''
            this.showAlert = false
        },

    },
    created() {
        this.getPlayers();
    }
  }
</script>

<style scoped>

</style>

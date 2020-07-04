<template>
    <div class="">
        <button class="btn btn-danger"  :disabled="disabledButton"  @click="changeGoalsValue('increments')"> Aumentar goles </button>
        <button class="btn btn-info" :disabled="disabledButton" @click="changeGoalsValue('decrements')"> Disminuir goles </button>
    </div>


</template>

<script>
  export default {
    name: "PlayerGoals",
    props: {
        player: {
            required: true,
            type: Object
        }
    },
    data() {
       return {
           disabledButton: false
       }
    },
    methods: {
        changeGoalsValue(operation) {

            if (operation === 'decrements' && this.player.goals < 1 ) return ""

            let me = this
            this.disabledButton = true;
            return axios.put(`players/${this.player.id}/goals/${operation}`).then(res => {
                me.disabledButton = !me.disabledButton
                me.$emit('reload_players')
            })
        }
    }
  }
</script>

<style scoped>

</style>

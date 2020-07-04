<template>
    <div
        v-show="showAlert"
        :class="[
            'alert',
            typeAlert
        ]"
        role="alert">
        {{ message }}
    </div>
</template>

<script>

  export default {
    name: "PlayerAlert",
    props: {
        typeAlert: {
            required: true,
            type: String
        },
        showAlert: {
            required: true,
            type: Boolean
        },
        message: {
            required: true,
            type: String
        }
    }
  }
</script>

<style scoped>

</style>

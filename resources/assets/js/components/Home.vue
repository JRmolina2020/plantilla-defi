<template>
  <div>
    <v-app>
      <v-container>
        <v-alert :value="true" type="success">{{ saludo }}</v-alert>
      </v-container>
    </v-app>
  </div>
</template>

<<script>
export default {
data () {
    return {
    saludo:'MOVIE DB'
    }
}
}
</script>
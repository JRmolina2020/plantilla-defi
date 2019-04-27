<template>
  <div>
    <v-app>
      <v-toolbar color="primary" app>
        <v-toolbar-side-icon @click="drawer = !drawer" dark></v-toolbar-side-icon>

        <v-toolbar-title class="white--text">Veterinaria cesar</v-toolbar-title>

        <v-spacer></v-spacer>
        <v-btn icon>
          <v-icon>more_vert</v-icon>
        </v-btn>
      </v-toolbar>
      <!-- menu vertical -->
      <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" app dark>
        <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://randomuser.me/api/portraits/men/85.jpg">
              </v-list-tile-avatar>

              <v-list-tile-content>
                <v-list-tile-title>John Leider</v-list-tile-title>
              </v-list-tile-content>

              <v-list-tile-action>
                <v-btn icon @click.stop="mini = !mini">
                  <v-icon>chevron_left</v-icon>
                </v-btn>
              </v-list-tile-action>
            </v-list-tile>
          </v-list>
        </v-toolbar>

        <v-list class="pt-0" dense>
          <v-divider></v-divider>

          <v-list-tile v-for="item in items" :key="item.title" :href="item.href">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
      <!-- end menu vertical-->
      <v-content>
        <v-container>
          <slot name="contenido"></slot>
        </v-container>
      </v-content>
    </v-app>
  </div>
</template>
<script>
export default {
  data() {
    return {
      drawer: true,

      items: [
        {
          title: "Home",
          href: "/",
          icon: "dashboard"
        },
        {
          title: "Categoria",
          href: "categoria",
          icon: "question_answer"
        }
      ],
      mini: true,
      right: null
    };
  }
};
</script>
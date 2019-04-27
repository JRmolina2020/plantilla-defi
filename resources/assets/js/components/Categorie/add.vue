<template>
  <div>
    <v-layout justify-space-between fill-height>
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
          <v-btn fab dark color="indigo" v-on="on">
            <v-icon dark>add</v-icon>
          </v-btn>
        </template>
        <v-form @submit.prevent="Save(form.id)" autocomplete="off">
          <v-card>
            <v-card-title>
              <span class="headline">Registrar categoria</span>
              <h1>{{ form.id }}</h1>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <!-- formulario categoria -->
                <v-text-field
                  v-model="form.name"
                  :error-messages="nameErrors"
                  :counter="10"
                  label="Categoria"
                  required
                  @input="$v.form.name.$touch()"
                  @blur="$v.form.name.$touch()"
                ></v-text-field>
                <!-- end formulario categoria -->
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn type="submit" :disabled="$v.$invalid">Guardar</v-btn>
              <v-btn color="green darken-1" flat @click="clear">Salir</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-layout>
  </div>
</template>
    
<script>
import { mapState, mapMutations } from "vuex";
import Vuelidate from "vuelidate";
import { validationMixin } from "vuelidate";
import { required, maxLength, minLength } from "vuelidate/lib/validators";
Vue.use(Vuelidate);

export default {
  validations: {
    form: {
      name: { required, maxLength: maxLength(10), minLength: minLength(4) }
    }
  },
  data() {
    return {
      //end
      //formulario
      form: {
        name: "",
        id: null
      },
      //end formulario
      //modal dialog
      dialog: false
    };
  },
  computed: {
    nameErrors() {
      const errors = [];
      if (!this.$v.form.name.$dirty) return errors;
      !this.$v.form.name.maxLength &&
        errors.push("Name must be at most 10 characters long");
      !this.$v.form.name.required && errors.push("Name is required.");
      !this.$v.form.name.minLength &&
        errors.push("El nombre debe tener minimo 4 letras");

      return errors;
    }
  },
  methods: {
    Createcategorie() {
      this.$store.dispatch("Createcategorie", item);
    }
  }
};
</script>

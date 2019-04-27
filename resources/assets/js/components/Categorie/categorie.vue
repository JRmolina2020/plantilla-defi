ntroducción
Aquí vamos a centrarnos en analizar los distintos tipos de algoritmos de planificación.  Estos algoritmos surgen debido a la necesidad de poder organizar los procesos de una manera eficiente para el procesador.
Los algoritmos de planificación se encargan de asegurar que un proceso no monopoliza el procesador. Un proceso es un programa que está en ejecución. Este proceso puede estar en 3 estados distintos  “Listo” “Bloqueado” y “En Ejecución”. Los procesos son almacenados en una lista  junto con la información que indica en qué estado está el proceso, el tiempo que ha usado el CPU, etc.

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
    <!-- table -->
    <v-layout justify-center row>
      <v-flex lg6>
        <template>
          <v-card>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Buscar"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="categorie" :search="search">
              <template v-slot:items="props">
                <td class="text-xs-center">{{ props.item.name }}</td>
                <td class="text-xs-center">
                  <v-btn v-if="props.item.state==1" flat icon color="green lighten-1">
                    <v-icon>check_circle</v-icon>
                  </v-btn>
                  <v-btn v-else flat icon color="red darken-2">
                    <v-icon>clear</v-icon>
                  </v-btn>
                </td>
                <td class="text-xs-center">
                  <v-btn @click="Show(props.item)" flat icon color="orange ">
                    <v-icon>border_color</v-icon>
                  </v-btn>
                  <v-btn @click="Delete(props.item.id)" flat icon color="red darken-3">
                    <v-icon>delete_forever</v-icon>
                  </v-btn>
                </td>
              </template>
              <template v-slot:no-results>
                <v-alert
                  :value="true"
                  color="error"
                  icon="warning"
                >Su búsqueda de "{{ search }}" No se encuentra.</v-alert>
              </template>
            </v-data-table>
          </v-card>
        </template>
      </v-flex>
    </v-layout>
  </div>
</template>
<script>
//form validations
import Vuelidate from "vuelidate";
import { validationMixin } from "vuelidate";
import { required, maxLength, minLength } from "vuelidate/lib/validators";

Vue.use(Vuelidate);

//end form validations
export default {
  //validations init
  validations: {
    form: {
      name: { required, maxLength: maxLength(10), minLength: minLength(4) }
    }
  },

  //end validations init
  data() {
    return {
      //errors
      errors: [],
      //end
      //formulario
      form: {
        name: "",
        id: null
      },
      //end formulario
      search: "",
      headers: [
        { text: "categoria", value: "name", align: "center" },
        { text: "Estado", value: "state", align: "center" },
        { text: "Opciones", value: "Opciones", align: "center" }
      ],
      categorie: [],
      //modal dialog
      dialog: false
    };
  },
  mounted() {
    this.Listcategorie();
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
    Listcategorie() {
      let url = "categorie";
      axios.get(url).then(response => {
        this.categorie = response.data;
      });
    },
    Save(id) {
      if (id == null) {
        if (!this.$v.$invalid) {
          let url = "categorie";
          axios
            .post(url, {
              name: this.form.name
            })
            .then(response => {
              this.Listcategorie();
              this.errors = [];
              this.clear();
              //mensaje exitoso

              //
            })
            .catch(error => {
              this.errors = error.response.data;
            });
        } else {
          console.log("❌ Invalid form");
        }
      } else {
        //si tiene un id como parametros es por que el usuario desear
        //editrar un registro,y entra al else de lo contraio ejectura el metodo Save()
        let url = "categorie/" + id;
        axios.put(url, this.form).then(response => {
          this.Listcategorie();
          this.clear();
          Swal.fire("Editar!", "Editado con exito!", "success");
        });
      }
    },
    Delete(id) {
      let url = "categorie/" + id;
      Swal.fire({
        title: "Esta seguro?",
        text: "Una vez eliminado el registro no se podra recuperar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete(url)
            .then(response => {
              Swal.fire("Eliminado!", "Transaccion exitosa.", "success");
              this.Listcategorie();
            })
            .catch(err => {
              Swal.fire(
                "No se puede eliminar!",
                "Tiene peliculas asignadas.",
                "success"
              );
            });
        }
      });
    },
    Show(item) {
      this.dialog = true;
      this.form.id = item.id;
      this.form.name = item.name;
    },
    clear() {
      this.$v.$reset();
      this.form.name = "";
      this.dialog = false;
    }
  }
};
</script>


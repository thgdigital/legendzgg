<template>


    <form v-on:submit.prevent="onSubmit">
        <div>
            <b-alert :show="dismissCountDown"
                     fade
                     dismissible
                     @dismissed="dismissCountDown=0"
                     @dismiss-count-down="countDownChanged"
                     variant="success">{{messagem}}</b-alert>
            <b-alert :show="showError" variant="danger">{{messagem}}</b-alert>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group has-feedback"
                     v-bind:class="

                      [errors.first('name') ? 'has-error' : '']

                      ">
                    <label>Nome da Rifa</label>
                    <input type="text"  v-model="item.name" v-validate="'required'" required class="form-control" name="name" placeholder="Digite nome do item">


                    <span class="help-block">
                                    <strong>{{ errors.first('name') }}</strong>
                                </span>
                </div>
            </div>
            <div class="col-sm-6" id="slug">
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" v-model="slug" class="form-control"  placeholder="Digite o slug" disabled>
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-sm-6">

        <div class="form-group"
             v-bind:class="

                      [errors.first('date_inicio') ? 'has-error' : '']

                      ">
            <label>Data de inicio</label>
            <input type="date" v-model="item.date_inicio"  name="date_inicio" v-validate="'date_format:DD/MM/YYYY'" required  class="form-control" placeholder="Digite da de inicio" >
            <span class="help-block">
                                    <strong>{{ errors.first('date_inicio') }}</strong>
                                </span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group"
             v-bind:class="

                      [errors.first('date_fim') ? 'has-error' : '']

                      ">
                    <label>Date de término</label>

            <input type="date" v-model="item.date_fim"  name="date_fim" v-validate="'date_format:DD/MM/YYYY'" required  class="form-control" placeholder="Digite a data de término" >


            <span class="help-block">
                                    <strong>{{ errors.first('date_fim') }}</strong>
                                </span>
        </div>
    </div>
</div>

        <input  type="submit"  value="Salvar dados" class="btn btn-primary btn-sm"/>
    </form>
</template>

<script>
    export default {
        props:['id'],
        mounted() {
            this.item.idCat = this.id
        },
        data () {
            return {
                messagem:null,
                showSucess: false,
                showError:false,
                dismissCountDown:0,
                item: {
                    name: "",
                    slug: null,
                    date_fim: null,
                    date_inicio: null,

                }
            }
        },
        mounted() {
            this.item.idCat = this.id
        },
        computed: {
            slug: function() {
                this.item.slug =this.sanitizeTitle(this.item.name);
                return this.item.slug;
            }
        },
        methods: {
            countDownChanged (dismissCountDown) {
                this.dismissCountDown = dismissCountDown

                if(this.dismissCountDown == 0){
                    location.reload()
                }
            },
            onSubmit (evt) {

                window.axios.post('/api/rifas/salved', this.item).then(({ data }) => {
                    if(data.error == false){
                    this.showSucess = true
                    this.showError = false
                    this.messagem = "Dados salvos com sucesso";
                    this.dismissCountDown = 5

co

                    }else{
                    this.messagem = "Error ao salvar dados";
                    this.showSucess = false
                    this.showError = true
                    }

                });
            },
            sanitizeTitle: function(title) {
                var slug = "";
                // Change to lower case
                var titleLower = title.toLowerCase();
                // Letter "e"
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                // Letter "a"
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                // Letter "o"
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                // Letter "u"
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                // Letter "d"
                slug = slug.replace(/đ/gi, 'd');
                // Trim the last whitespace
                slug = slug.replace(/\s*$/g, '');
                // Change whitespace to "-"
                slug = slug.replace(/\s+/g, '-');
                slug = slug.replace(/--/g, '-');

                return slug;
            },
        }
    }
</script>

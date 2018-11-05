<template>
    <div class="row">

            <div class="col-sm-12">
                <b-alert :show="showSucess" variant="success">{{title}}</b-alert>
                <b-alert :show="showError" variant="danger">{{title}}</b-alert>
                <form @submit="onSubmit">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group has-feedback"
                                 v-bind:class="

                          [errors.first('name') ? 'has-error' : '']

                          ">
                                <label>Nome do Item</label>
                                <input type="text"  v-model="item.name" v-validate="'required'" class="form-control" name="name" placeholder="Digite nome do item">


                                <span class="help-block">
                                        <strong>{{ errors.first('name') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-6" id="slug">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" v-model="slug" class="form-control" placeholder="Digite o slug" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group has-feedback" v-bind:class="

                          [errors.first('valor_rifa') ? 'has-error' : '']

                          ">
                                <label>Valor de rifa</label>
                                <money v-model="item.valor_rifa" class="form-control"  v-validate="'required'" name="valor_rifa" v-bind="money"></money>
                                <span class="help-block">
                                        <strong>{{ errors.first('valor_rifa') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-feedback">
                                <label>Valor de venda</label>
                                <money v-model="item.valor_venda" name="valor_venda" v-validate="'required'" class="form-control" v-bind="money"></money>
                                <span class="help-block">
                                        <strong>{{ errors.first('valor_venda') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group has-feedback">
                                <label>Valor de rp</label>
                                <money v-model="item.valor_rp" name="valor_rp" v-validate="'required'" class="form-control" v-bind="money"></money>
                                <span class="help-block">
                                        <strong>{{ errors.first('valor_rp') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group" v-bind:class="

                          [errors.first('number') ? 'has-error' : '']

                          ">
                                <label>Numero de rifas</label>
                                <input type="number" v-model="item.number" v-validate="'required'"  name="number" class="form-control" placeholder="Digite o slug" >
                                <span class="help-block">
                                        <strong>{{ errors.first('number') }}</strong>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" v-bind:class="

                          [errors.first('credito') ? 'has-error' : '']

                          ">
                                <label>Valor de creditos</label>
                                <money v-model="item.valor_credito" name="credito" v-validate="'required'" class="form-control" v-bind="money"></money>

                                <span class="help-block">
                                        <strong>{{ errors.first('credito') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" v-bind:class="

                          [errors.first('essencia') ? 'has-error' : '']

                          ">
                                <label>Valor de essencia</label>
                                <money v-model="item.valor_essencia" name="essencia" v-validate="'required'" class="form-control" v-bind="money"></money>

                                <span class="help-block">
                                        <strong>{{ errors.first('essencia') }}</strong>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" v-bind:class="

                          [errors.first('tipo') ? 'has-error' : '']

                          ">
                                <select name="tipo" class="form-control"  v-model="item.tipo">
                                    <option value="">Selecione um tipo</option>
                                    <option v-model="tipo.id"

                                            v-for="tipo in tipos"
                                            v-bind:value="tipo.id">{{tipo.name}}</option>
                                </select>
                                <span class="help-block">
                                        <strong>{{ errors.first('tipo') }}</strong>
                                    </span>
                                </div>
                        </div>
                    </div>
                    <b-form-group id="exampleGroup4">
                        <b-form-checkbox v-model="item.resgatavel"> Resgatavel </b-form-checkbox>
                        <b-form-checkbox v-model="item.ativo"> Ativado </b-form-checkbox>
                    </b-form-group>


                </form>
                <br/>
                <br/>
                <b-modal ref="myModalRef" hide-footer title="Using Component Methods">
                    <div class="d-block text-center">
                        <h3>{{title}}</h3>
                    </div>
                    <b-btn class="mt-3" variant="outline-danger" block @click="hideModal">Fechar</b-btn>
                </b-modal>
                <button class="btn btn-primary btn-sm"  v-on:click="onSubmit">Atualizar dados</button>
            </div>

        </div>
</template>

<script>
    var baseUrl = $('meta[name=base-url]').attr("content");

    function Items({id, name, date_inicio,date_fim, created_at, updated_at, imagem, status, num_rifias, slug, valor_rifa,valor_venda ,valor_rp, valor_credito,valor_essencia, resgatavel, tipo_items_id}) {
        this.id = id;
        this.created_at = created_at;
        this.date_inicio = date_inicio;
        this.date_fim = date_fim;
        this.name = name;
        this.updated_at = updated_at
        this.imagem = baseUrl+"/assets/imagem/rifas/"+imagem
        this.number= num_rifias
        this.slug = slug
        this.valor_rifa = valor_rifa.toFixed(2).replace('.', ',')
        this.valor_venda = valor_venda.toFixed(2).replace('.', ',')
        this.valor_rp = valor_rp.toFixed(2).replace('.', ',')
        this.resgatavel = resgatavel == 1 ? true: false
        this.status = status == 1 ? "Ativado": "Desativado"
        this.ativo = status == 1 ? true: false
        this.valor_credito = valor_credito
        this.valor_essencia = valor_essencia
        this.tipo = tipo_items_id

    }
    export default {
        props:['id'],
            data () {
            return {
                title:'',
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: 'R$ ',
                    suffix: '',
                    precision: 2,
                    masked: false
                },
                item:{},
                tipos:null,
                baselUrl:baseUrl,
                form: {
                    email: '',
                    name: '',
                    food: null,
                    checked: []
                },
                foods: [
                    { text: 'Select One', value: null },
                    'Carrots', 'Beans', 'Tomatoes', 'Corn'
                ],
                showSucess: false,
                showError: false,
                file2: null
            }
        },
        mounted() {


            window.axios.get('/api/rifas/items/'+this.id).then(({ data }) => {

            this.tipos = data.tipo
            this.item = new Items(data.items)
        }).catch((err) =>{
                this.title = "Oppss Error ao buscar dados"
        })


        },
        computed: {
            slug: function() {
                this.item.slug =this.sanitizeTitle(this.item.name);
                return this.item.slug;
            }
        },
        methods: {
            onSubmit (evt) {

                window.axios.post('/api/rifas/salvar', this.item).then(({ data }) => {
                    if(data.status == true){
                    this.title = "Dados Atualizado com sucesso"
                    this.showSucess = true
                    this.showError = false

                    }else{
                        this.title = "Oppss Error ao alterar dados"
                        this.showSucess = false
                        this.showError = true
                }

            }).catch((err) =>{
                this.title = "Oppss Error ao alterar dados"
                this.showSucess = false
                this.showError = true
            })
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
            onReset (evt) {
                evt.preventDefault();
                /* Reset our form values */
                this.form.email = '';
                this.form.name = '';
                this.form.food = null;
                this.form.checked = [];
                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            },
            hideModal () {
                this.$refs.myModalRef.hide()
            }
        }
    }
</script>
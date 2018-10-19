<template>





            <div class="row">

                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>

                            <th>Data de inicio</th>
                            <th>Data de fim</th>

                            <th>Data de criação</th>
                            <th>Data de atualização</th>

                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="rifa in rifas">
                            <td>{{rifa.id}}</td>
                            <td>{{rifa.name}}</td>
                            <td>{{rifa.date_inicio |  moment("D/MM/Y")}}</td>
                            <td>{{rifa.date_fim |  moment("D/MM/Y")}}</td>

                            <td>{{rifa.created_at | moment("D/MM/Y")}}</td>
                            <td>{{rifa.updated_at |  moment("D/MM/Y")}}</td>

                            <td>

                                <a v-bind:href="rifa.urlEdit" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                <a v-bind:href="rifa.items" class="btn btn-primary  btn-xs"><i class="fa  fa-sitemap"></i></a>
                                <button class="btn btn-danger  btn-xs"><i class="fa fa-fw fa-trash-o"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>







</template>

<script>
    var baseUrl = $('meta[name=base-url]').attr("content");

    function Items({ id,  name, date_inicio,date_fim, created_at, updated_at, imagem, status, num_rifias, jogadors}) {
        this.id = id;
        this.created_at = created_at;
        this.date_inicio = date_inicio;
        this.date_fim = date_fim;
        this.name = name;
        this.updated_at = updated_at
        this.imagem = baseUrl+"/assets/imagem/rifas/"+imagem
        this.number= num_rifias
        this.urlEdit = baseUrl+"/admin/rifas/edit/"+this.id
        this.items = baseUrl+"/admin/rifas/items/"+this.id



        this.status = status == 1 ? "Ativado": "Desativado"
        this.class = status
    }
export default {

    data() {
        return {
            rifas: [],
            baselUrl:baseUrl
        }
    },
    props:['id'],
    mounted() {

        window.axios.get('/api/rifas/list-rifas/'+this.id).then(({ data }) => {
            console.log(data)
            data.forEach(rifa => {
            this.rifas.push(new Items(rifa));

            });
        });
    },
    methods: {
        showModal () {
            this.$refs.myModalRef.show()
        },
        hideModal () {
            this.$refs.myModalRef.hide()
        }
    }

}
</script>
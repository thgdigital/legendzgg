<template>

<div class="row">

    <div class="col-sm-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Imagem</th>
                <th>N Rifas</th>
                <th>Vendida</th>
                <th>Porcentagem</th>

                <th>Data de criação</th>
                <th>Data de atualização</th>

                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="rifa in rifas">
                <td>{{rifa.id}}</td>
                <td>{{rifa.name}}</td>

                <td>
                    <b-img rounded  width="75" height="75"
                           alt="rifa.name" class="m-1" v-bind:src="rifa.imagem"/>

                    </td>
                <td><span class="label label-primary">{{rifa.number}}</span> </td>
                <td>

                    <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-primary"
                             v-bind:style="{width: rifa.total}"

                             ></div>
                    </div>
                </td>
                <td><span class="badge label-primary">{{rifa.total}}</span> </td>
                <td>{{rifa.created_at |  moment("D/MM/Y")}}</td>
                <td>{{rifa.updated_at |  moment("D/MM/Y")}}</td>
                <td>
                    <span class="label "
                        v-bind:class="

                          [rifa.class ? 'label-success' : 'label-danger']

                          ">{{rifa.status}}</span>
                    </td>
                <td>
                    <a v-bind:href="rifa.urlEdit" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                    <a v-bind:href="rifa.urlImage" class="btn btn-primary btn-xs"><i class="fa  fa-file-image-o"></i></a>
                    <a v-bind:href="rifa.numberurl" class="btn btn-primary  btn-xs"><i class="fa  fa-bookmark-o"></i></a>
                    <button class="btn btn-danger  btn-xs"><i class="fa fa-fw fa-trash-o"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
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
        this.urlEdit = baseUrl+"/admin/items/edit/"+this.id
        this.numberurl = baseUrl+"/admin/items/number/"+this.id
        this.urlImage = baseUrl+"/admin/rifas/items/image/"+this.id

        this.total =  Math.round((jogadors.length /100 * this.number))+"%"



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
    props:['name'],
    mounted() {

        window.axios.get('/api/rifas/'+this.name).then(({ data }) => {
            data.forEach(rifa => {
                rifa.items.forEach(items => {

                    this.rifas.push(new Items(items));
                })
            });
        });
    }

}
</script>
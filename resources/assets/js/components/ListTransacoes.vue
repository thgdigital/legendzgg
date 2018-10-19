<template>





            <div class="row">

                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comprador</th>

                            <th>Valor de compras</th>
                            <th>Status</th>

                            <th>Data de criação</th>
                            <th>Data de atualização</th>

                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="trans in transacao">
                            <td>{{trans.id}}</td>

                            <td>{{trans.order.jogador.username}}</td>
                            <td>
                                {{trans.order.valor_total | currency}}
                            </td>
                            <td>
                                <span class="label label-warning" v-if="trans.status == 1">Aguardando pagamento</span>
                                <span class="label label-primary" v-if="trans.status == 2">Em análise</span>
                                <span class="label label-success" v-if="trans.status == 3" >Paga</span>
                                <span class="label label-success" v-if="trans.status == 4" >Disponível</span>
                                <span class="label label-warning" v-if="trans.status == 5" >Em disputa</span>
                                <span class="label label-danger" v-if="trans.status == 6" >Devolvida</span>
                                <span class="label label-danger" v-if="trans.status == 7" >Cancelada</span>
                                <span class="label label-primary" v-if="trans.status == 8" >Debitado</span>
                                <span class="label label-danger" v-if="trans.status == 9" >Retenção temporária</span>

                            </td>

                            <td>{{trans.created_at |  moment("D/MM/Y")}}</td>
                            <td>{{trans.updated_at |  moment("D/MM/Y")}}</td>

                            <td>
                                <a v-bind:href="trans.libereCredit" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-money"></i></a>
                                <!--<a v-bind:href="rifa.urlImage" class="btn btn-primary btn-xs"><i class="fa  fa-file-image-o"></i></a>-->
                                <!--<button v-bind:href="rifa.urlEdit" class="btn btn-primary  btn-xs"><i class="fa  fa-file"></i></button>-->
                                <!--<button class="btn btn-danger  btn-xs"><i class="fa fa-fw fa-trash-o"></i></button>-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>








</template>

<script>
    var baseUrl = $('meta[name=base-url]').attr("content");

    function Transacao({jogador, order}){
      this.jogador = jogador
    }
export default {

    data() {
        return {
            transacao: [],
            baselUrl:baseUrl,
            urlEdit: null,
            libereCredit: null,
//            money: {
//                decimal: ',',
//                thousands: '.',
//                prefix: 'R$ ',
//                suffix: '',
//                precision: 2,
//                masked: false
//            }
        }
    },

    mounted() {
       this.libereCredit = this.baselUrl+"/admin/transacao/credit";

        window.axios.get('/api/transacao').then(({ data }) => {

            data.forEach(trans => {

            trans.libereCredit =  this.libereCredit+"/"+trans.id
            this.transacao.push(trans)
        })


            console.log(this.transacao)
        });

        console.warn(this.libereCredit)
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
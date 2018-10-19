@component('mail::message')


Olá recebemos seu novo pedido<br/><br/>

@component('mail::table')
| Descrição       | Quantidade         | Total  |
| ------------- |:-------------:| --------:|
| Compra de Creditos     | <?php echo intval($orderPedido['valor_total'])?> quantidade | R$ <?php echo number_format($orderPedido['valor_total'], 2, '.', ','); ?>   |

@endcomponent

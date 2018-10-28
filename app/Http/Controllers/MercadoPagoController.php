<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use MP;

class MercadoPagoController extends Controller
{


    public function mp(Request $request)
    {
        return view('mercadopago.mpformcartao');
    }

    public function mpPost(Request $request)
    {
        
        $mp = new MP('TEST-7273950905061467-102200-f866eb2a3b9b7eb6e4750f5f5930923c-61220490');

        //Produto
        $id      = $request['id'];
        $nome    = $request['nome'];
        $qtde     = $request['qtde'];
        $qtde     = $request['qtde'];
        $total   = $request['total'];

        $item = array(
            "id"            => $id,
            "title"         => $nome,
            "quantity"      => $qtde,
            "unit_price"    => $total
        );

        //ARRAY PAGTO
        if (isset($request['token'])) {

            $payment_preference = array(
                "token" => $request['token'],
                "installments" => (int)$request['parcelas_quantidade'], // QUANTIDADE DE PARCELAS ESCOLHIDAS PELO COMPRADOR.
                "transaction_amount" => round((float)$total, 2), // VALOR TOTAL A SER PAGO PELO COMPRADOR.
                //"coupon_amount" => valor do desconto,
                //"external_reference" => $pedido->id_pedido, // NUMERO DO PEDIDO DE SEU SITE PARA FUTURA CONCILIAÇÃO FINANCEIRA.
                "binary_mode" => false, // SE DEFINIDO true DESLIGA PROCESSO DE ANÁLISE MANUAL DE RISCO, PODE REDUZIR APROVAÇÃO DAS VENDAS SE NÃO CALIBRADO PREVIAMENTE.
                //"description" => "MINHA LOJA - PEDIDO-123456", // DESCRIÇÃO DO CARRINHO OU ITEM VENDIDO.
                "payment_method_id" => $request['paymentMethodId'], // MEIO DE PAGAMENTO ESCOLHIDO.
                "statement_descriptor" => "NOME LOJA", // ESTE CAMPO IRÁ NA APARECER NA FATURA DO CARTÃO DO CLIENTE, LIMITADO A 10 CARACTERES.
                "notification_url" => "http://www.SEUSITE.com.br/retorno.php", //ENDEREÇO EM SEU SISTEMA POR ONDE DESEJA RECEBER AS NOTIFICAÇÕES DE STATUS: https://www.mercadopago.com.br/developers/pt/solutions/payments/custom-checkout/webhooks/

                "payer" => array(
                    "email" => $request['email'] //E-MAIL DO COMPRADOR
                ),

                "additional_info" => array(  // DADOS ESSENCIAIS PARA ANÁLISE ANTI-FRAUDE

                    //PARA CADA ITEM QUE ESTÁ SENDO VENDIDO É CRIADO UM ARRAY DENTRO DESTE ARRAY PAI COM AS INFORMAÇÕES DESCRITAS ABAIXO
                    "items" => array($item),

                    "payer" => array( //INFORMAÇÕES PESSOAIS DO COMPRADOR
                        "first_name" => $request['nome'], //NOME DO COMPRADOR
                        "last_name" => $request['sobrenome'], //SOBRENOME DO COMPRADOR
                        //"registration_date" => "2014-06-28T16:53:03.176-04:00", //DATA EM QUE O COMPRADOR FOI CADASTRADO COMO CLIENTE
                        "phone" => array( //Telefone do Comprador
                            "area_code" => $request['ddd'], //DDD
                            "number" => $request['telefone'] //NÚMERO
                        ),
                    ),
                    /*
                    "shipments" => array( //INFORMAÇÕES DO LOCAL ONDE O ITEM SERÁ ENTREGUE
                        "receiver_address" => array(
                            "zip_code"      => "", //CEP
                            "street_name"   => "", //Logradouro
                            "street_number" => "", //Número
                            "floor"         => "", //Andar
                            "apartment"     => "" //Apto
                        ),
                    ),
                    */
                ),
            );

            $response_payment = $mp->post("/v1/payments/", $payment_preference);

            if ($response_payment['status'] == 201) {

                echo "<div class='mx-auto mt-4 mb-4' style='width: 580px;'>";
                echo "<div class='card'>";
                echo "<h4 class='card-header bg-success text-white'>Sucesso!</h4>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Obrigado!</h5>";
                echo "<p>Seu pedido foi recebido com sucesso!</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

            } else {
                echo "<div class='mx-auto mt-4 mb-4' style='width: 580px;'>";
                echo "<div class='card'>";
                echo "<h4 class='card-header bg-danger text-white'>";
                echo "Ooops! Não foi possível prosseguir :/<br>";
                echo "</h4>";
                echo "<div class='card-body'>";
                echo "<p>Houve uma falha.</p>";
                echo "</div>";
                echo "</div>";
            }

        } else {
            echo "<div class='alert alert-danger mx-auto' role='alert' style='width: 580px;'>";
            echo "Ooops! Houve uma falha. (token)";
            echo "</div>";
        }


        //return view('mp.autoriza_cartao');
    }   
    


}
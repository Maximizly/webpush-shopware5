{extends file="parent:frontend/checkout/finish.tpl"}

{block name='frontend_checkout_finish_items'}
    {$smarty.block.parent}

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            maximizly.push(['trackEcommerceOrder',
                "{$sOrderNumber}",
                {$sAmountNet},
                "{$Shop->getCurrency()->getCurrency()}"
            ]);
        }, true);
    </script>
{/block}

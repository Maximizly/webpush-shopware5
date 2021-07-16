{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_javascript_async_ready"}
    {if {config name='maximizlyWebpushActive'}}
        <!-- Maximizly Module enabled -->
        <script>
            let maximizly = []; maximizly['webpush_domain'] = '{config name="maximizlyWebpushDomain"}';
        </script>
        <script src="https://maximizly.s3.eu-central-1.amazonaws.com/sources/webpush/production/js/maximizly-push.js" defer></script>
    {else}
        <!-- Maximizly Module deactivated -->
    {/if}
    {$smarty.block.parent}
{/block}

{include file="../_general/header.tpl" title={$title}}


{* no if isset($dFormJSON) required, since we know this view expects that token *}
{include file="../_general/dForm_block.tpl" }


<br/> 
<a href='{$APP_WEB_ROOT}/public/register'>Register</a><br />
<a href='{$APP_WEB_ROOT}/public/recover' >Forgot password?</a>


<script type="text/javascript" >
$('#{$dFormId}').on('submit', function(ev) {
	// console.log('we can hash the data');
});
</script>


{include file="../_general/footer.tpl"}
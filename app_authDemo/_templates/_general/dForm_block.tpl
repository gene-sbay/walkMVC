{if ! isset($debug1) }
	{assign var="debug1" value=99 nocache}
{/if}

{if ($debug1 eq 99 ) }
<div style='padding: 5px; border: 5px orange solid' >
debug formJSON: {$dFormJSON}
</div>
{/if}



<form id="{$dFormId}"></form>

<script type="text/javascript" >

function {$loadFormFunc} 
{
	dbg ('enter go');
	// jqueryAjax(null, 'http://localhost/dev/jq.dform_demo/app1/post/post_ctrl.php', submitNewPost);
	var dFormId = '{$dFormId}';
	var dFormJson = {$dFormJSON};
	set_dForm(dFormId, dFormJson);
}

</script>
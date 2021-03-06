<?php

$app->get('/access/post/home', 'viewPostIndex' );

$app->get('/access/post/edit', 'viewPostEdit' );
$app->get('/access/post/edit/:id', 'viewPostEdit' );

$app->get('/access/post/delete/:id', 'viewConfirmPostDelete' );
$app->get('/access/post/deleteConfirm/:id', 'actionPostDelete' );

$app->post('/access/post/save', 'actionPostSave' );

/**
 * Because there is only a simple get ->all() invocation,
 * don't think we need controller overhead
 */
function viewPostIndex() 
{
	global $smarty;
	
	$postCtrl = new PostLogic();
	$items = $postCtrl->actionIndex();	

	$smarty->assign("items",$items);		
	$smarty->display('post/post_home.tpl');
}

/**
 * This function loads an empty form
 * No need to use a controller for this render
 */
function viewPostEdit($id=null) 
{
	global $smarty;
	
	$postFormCfg = new PostFormConfig();

	if ( $id )
	{
		$adapter = getDbAdapter();
		$postMapper = new PostMapper($adapter);
		
		$post = $postMapper->first(
									array
									(
										'id' => $id
									)
								);
		
		if ($post)
		{
			$postFormCfg->updateId['value'] = $post->id;
			$postFormCfg->title['value'] = $post->title;
			$postFormCfg->body['value'] = $post->body;
			$postFormCfg->status['value'] = $post->status;
		}
		else
		{
			$smarty->assign("error_msg","Error loading db");
		}
	}
	
	$postFormCfg->loadFormFieldArray();
	$postJsonArr = $postFormCfg->jsonArr; // getJsonArray();
	
	$postDForm = new dFormBean();
	$postDForm->action = $postFormCfg->action;
	$postDForm->dFormId = $postFormCfg->formId;
	$postDForm->dFormJSON = $postJsonArr;
	$postDForm->loadFunctionString = 'loadPostForm()';
	
	$loadFormFuncArr[] = $postDForm;
	$smarty->assign('loadFormFuncArr', $loadFormFuncArr);
	
	$smarty->display('post/post_edit.tpl');
}

function viewConfirmPostDelete($id=null) 
{
	global $smarty;
	
	$smarty->assign("postId",$id);
	$smarty->display('post/post_delete.tpl');
	
}

function actionPostDelete($id=null) 
{
	global $app;
	
	if ( $id )
	{
		$adapter = getDbAdapter();
		$postMapper = new PostMapper($adapter);
			
		$postMapper->delete(
				array
				(
						'id' => $id
				)
		);
	}

	$app->redirect('../../post/home');
}

/**
 * Works for both create and update
 */
function actionPostSave() 
{
	global $app;
	
	$postCtrl = new PostLogic();
	$postCtrl->actionSave();
	$app->redirect('./home');
}

?>
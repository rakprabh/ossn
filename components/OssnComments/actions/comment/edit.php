<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$guid    = input('guid');
$text    = input('comment');
$comment = ossn_get_annotation($guid);

if(!$comment || empty($text)) {
		ossn_trigger_message(ossn_print('comment:edit:failed'), 'error');
		redirect(REF);
}
//editing, then saving a comment gives warning #685
$comment->data	= new stdClass;
if($comment->type == 'comments:entity') {
		$comment->data->{'comments:entity'} = $text;
} elseif($comment->type == 'comments:post') {
		$comment->data->{'comments:post'} = $text;
}
$user = ossn_loggedin_user();
if(($comment->owner_guid == $user->guid || $user->canModerate()) && $comment->save()) {
		$params               = array();
		$params['text']       = $text;
		$params['annotation'] = $comment;
		ossn_trigger_callback('comment', 'edited', $params);
		
		ossn_trigger_message(ossn_print('comment:edit:success'));
		redirect(REF);
} else {
		ossn_trigger_message(ossn_print('comment:edit:failed'), 'error');
		redirect(REF);
}
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
 if(isset($params['comment']->{'comments:entity'})){
	 $comment = $params['comment']->getParam('comments:entity');
 }
 if(empty($comment) && isset($params['comment']->{'comments:post'})){
	 $comment = $params['comment']->getParam('comments:post');
 }
 if(empty($comment)){
	 return;
 }
 ?>
 <div>
 	<textarea id="comment-edit" name="comment"><?php echo  $comment;?></textarea>
    <input type="hidden"  name="guid" value="<?php echo $params['comment']->getID();?>" />
    <input type="submit" class="hidden" id="ossn-comment-edit-save" />
 </div>

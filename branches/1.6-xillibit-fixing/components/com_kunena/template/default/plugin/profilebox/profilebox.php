<?php
/**
 * @version $Id$
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2009 Kunena Team All rights reserved
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.com
 *
 **/

// Dont allow direct linking
defined ( '_JEXEC' ) or die ();
require_once (KUNENA_PATH_LIB . DS . 'kunena.login.php');
$this->user = JFactory::getUser();
$this->config = & CKunenaConfig::getInstance ();
$type = CKunenaLogin::getType ();
$return = CKunenaLogin::getReturnURL ( $type );

if ($type == 'logout') {
?>
<form action="index.php" method="post" name="login">
	<table class="kprofilebox" id="kprofilebox">
		<tbody id="topprofilebox_tbody">
			<tr class="ksectiontableentry1">
				<td class="kprofilebox-left center" width="1%">
					<?php echo CKunenaLogin::getMyAvatar(); ?>
				</td>
				<td class="kprofileboxcnt left">
					<ul class="kprofilebox_link">
						<li><?php echo CKunenaLink::GetShowLatestLink(JText::_('COM_KUNENA_PROFILEBOX_SHOW_LATEST_POSTS')); ?></li>
						<li><?php echo CKunenaLink::GetSearchLink ( $this->config, 'search', '', 0, 0, JText::_('COM_KUNENA_SEARCH_ADVSEARCH') ); ?></li>
						<?php
						$user_fields = @explode ( ',', $this->config->annmodid );
						if (in_array ( $this->my->id, $user_fields ) || $this->my->usertype == 'Administrator' || $this->my->usertype == 'Super Administrator') {
							$is_editor = true; } else { $is_editor = false; }
						if ($is_editor) { ?>
							<li><a href="<?php echo CKunenaLink::GetAnnouncementURL ( $this->config, 'show' ); ?>"><?php echo JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS'); ?></a></li>
						<?php } ?>
					</ul>
					<ul class="kprofilebox_welcome">
						<li><?php echo JText::_('COM_KUNENA_PROFILEBOX_WELCOME'); ?>, <strong><?php echo CKunenaLink::GetProfileLink ( $this->config, $this->user->id, $this->kunena_username ); ;?></strong></li>
						<li class="kms"><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_LASTVISITDATE'); ?>:</strong> <span title="<?php echo CKunenaTimeformat::showDate($this->user->lastvisitDate, 'ago', 'utc'); ?>"><?php echo CKunenaTimeformat::showDate($this->user->lastvisitDate, 'date_today', 'utc'); ?></span></li>
						<li>
							<input type="submit" name="Submit" class="kbutton" value="<?php echo JText::_('COM_KUNENA_PROFILEBOX_LOGOUT'); ?>" /> <input type="hidden" name="option" value="com_user" />
							<input type="hidden" name="task" value="logout" />
							<input type="hidden" name="return" value="<?php echo $return; ?>" />
						</li>
					</ul>
				</td>
					<?php if (JDocumentHTML::countModules ( 'kunena_profilebox' )) { ?>
				<td class = "kprofilebox-right">
					<div class="kprofilebox_modul">
						<?php CKunenaTools::showModulePosition( 'kunena_profilebox' ); ?>
					</div>
				</td>
					<?php } ?>
			</tr>
		</tbody>
	</table>
</form>
<?php
} else {
// LOGOUT AREA
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kprofilebox">
	<tbody id="topprofilebox_tbody">
		<tr class="ksectiontableentry1">
			<td valign="top" class="kprofileboxcnt" align="left">
				<form action="index.php" method="post" name="login">
					<div class="k_guest">
						<?php echo JText::_('COM_KUNENA_PROFILEBOX_WELCOME'); ?>,
						<b><?php echo JText::_('COM_KUNENA_PROFILEBOX_GUEST'); ?></b>
					</div>
					<div class="input">
						<span>
							<?php echo JText::_('COM_KUNENA_A_USERNAME'); ?>
							<input type="text" name="username" class="inputbox ks" alt="username" size="18" />
						</span>
						<span>
							<?php echo JText::_('COM_KUNENA_PASS'); ?>
							<input type="password" name="passwd" class="inputbox ks" size="18" alt="password" /></span>
						<span>
							<input type="submit" name="Submit" class="kbutton" value="<?php echo JText::_('COM_KUNENA_PROFILEBOX_LOGIN'); ?>" />
							<input type="hidden" name="option" value="com_user" />
							<input type="hidden" name="task" value="login" />
							<input type="hidden" name="return" value="<?php echo $return; ?>" /> <?php echo JHTML::_ ( 'form.token' ); ?>
						</span>
					</div>
					<div class="link_block">
						<span class="kprofilebox_link">
							<?php echo CKunenaLogin::getLostPasswordLink (); ?>
						</span>
						<span class="kprofilebox_link">
							<?php echo CKunenaLogin::getLostUserLink ();?>
						</span>
							<?php $usersConfig = &JComponentHelper::getParams ( 'com_users' );
							if ($usersConfig->get ( 'allowUserRegistration' )) : ?>
						<span class="kprofilebox_link">
							<?php echo CKunenaLogin::getRegisterLink (); ?>
						</span>
							<?php endif; ?>
					</div>
				</form>
			</td>
				<?php if (JDocumentHTML::countModules ( 'kunena_profilebox' )) { ?>
			<td class = "kprofilebox-right">
				<div class="kprofilebox_modul">
					<?php CKunenaTools::showModulePosition( 'kunena_profilebox' ); ?>
				</div>
			</td>
			<?php } ?>
		</tr>
	</tbody>
</table>
<?php
}
?>

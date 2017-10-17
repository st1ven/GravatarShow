<?php
/**
 * Gravatar 头像显示插件
 * 
 * @package GravatarShow
 * @author SangSir
 * @version 1.0.0
 * @link https://sangsir.com
 */
class GravatarShow implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Comments')->gravatar = array('GravatarShow', 'getGravatar');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function getGravatar($size = 32, $rating, $default, $comments)
    {
        $mailHash = NULL;
		$default = empty($default) ? 'mm' : $default;
        if (!empty($comments->mail)) {
        $mailHash = md5(strtolower($comments->mail));
        }
        $url = 'https://secure.gravatar.com/avatar/';
        if (!empty($comments->mail)) {$url .= $mailHash;}
        $url .= '?s=' . $size;
        $url .= '&r=' . $rating;
        $url .= '&d=' . $default;
        echo '<img class="avatar" src="' . $url . '" alt="' .
        $comments->author . '" width="' . $size . '" height="' . $size . '" />';
    }
}
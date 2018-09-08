<?php

use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function BuildFields($name , $value = null , $type="text")
{
    $out = "";
    $i = 0;
    foreach(GetLangs() as  $key => $lan):
        $val = $value[$i++];

        $newValue = $value != null ? ($val[$name]) : null;
        
        if($val != null):
        	$ln = ($lan === $val['locale']) ? $lan : $val['locale'];
        else:
        	$ln = $lan;
        endif;

    	$class = ['class' => 'form-control', 'id' => $name, 'placeholder' => $name.' in '.$ln, 'required' => 'required'];
        $out .= '<div class="form-group">';
        $out .= '<div class="form-line">';
        
        $out .= Form::label($name, ucfirst($name).' Language '.$ln);
       
        if($type != 'textarea'):
        	$out .= Form::text($name.'['.$ln.']', $newValue, $class);
        else:
        	$out .= Form::textarea($name.'['.$ln.']', $newValue, array_merge($class, ['rows' => '3']));
        endif;
        
        $out .='</div>';
        $out .='</div >';
    endforeach;
    return $out;
}

function CheckIfMessageSuccessOrNot(){
	if (Session::has('success')):
	
		$out = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Message</strong> ';
		$out .= Session::get('success');
		$out .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		return $out;
	
	elseif(Session::has('error')):
	
		$out = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error Message</strong> ';
		$out .= Session::get('error');
		$out .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$out .= '</div>';
		return $out;
	
	endif;
}

function GetLangs(){
	return $lang = LaravelLocalization::getSupportedLanguagesKeys();
}

function CheckIfIsset($obj)
{
	return isset($obj) ? $obj : '';
}
function GetCurrentLang(){
	return LaravelLocalization::getCurrentLocale();
}
function GetUserRole($user){
	return App\Role::where('id', $user->roles[0]->id)->first();
}
function GetRoles(){
	return App\Role::all();
}
function GetLocalizedPath($localeCode){
    return LaravelLocalization::getLocalizedURL($localeCode, null, [], true);
}
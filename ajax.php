<?php
include "core/init.php";
$user = new user();

if(isset($_POST['img_page']))
{
    homegallery();
}
if(isset($_POST['picCounter']))
{
    imgCount();
}
if(isset($_POST['offset']))
{
    homegallery();
}
 if(isset($_POST['username']))
{
    usernameupdate2();
}
if(isset($_POST['email']))
{


    emailupdate2();
} 
if(isset($_POST['passwd_new']) && isset($_POST['passwd_current']) && isset($_POST['passwd_new_again']))
{

    passwordupdate2();
}



function homegallery()
{
    $db = DB::getInstance();
    $db->query("SELECT * FROM gallery ORDER BY time_stamp DESC LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}

//count images
function imgCount()
{
    $db = DB::getInstance();
    $db->query("SELECT * FROM gallery");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images); 
}





function passwordupdate2()
{
 
    if (input::exists()) {

               global $user;
            
            $validate = new validate();
            $validation = $validate->check($_POST, array(
                'passwd_current' => array(
                    'required' => true,
                    'min' => 6
                ),
                'passwd_new' => array(
                    'required' => true,
                    'min' => 6
                ),
                'passwd_new_again' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'passwd_new'
                )
            ));

            if ($validation->passed()) {
                if (hash::make(input::get('passwd_current')) !== $user->data()->passwd)
                {
                    echo "Your current password was incorrect :(";
                }
                else
                {
                    $user->update(array(
                        'passwd' => hash::make(input::get('passwd_new'))
                    ));
                    /* session::flash('home', 'Your password was updated');
                    redirect::to('index.php'); */
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, "<br>";
                }
            }
            
        
    }
}

    function usernameupdate2()
	{
        global $user;
		if (input::exists()) {

				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'min' => 2,
						'max' => 20,
						'unique' => 'users'
					),
				));
				if ($validation->passed())
				{
					try{
						$user->update(array(
							'username' => escape(input::get('username')),
						));
						/* session::flash('home', 'your details have been updated');
                        redirect::to('index.php'); */
                        echo "username updated";
					}
					catch(Exception $e)
					{
						die($e->getMessage()); 
					}
				}
				else{
					foreach ($validation->errors() as $error) {
						echo $error, '<br>';
					}
				}
			
		}
	}
	
	function emailupdate2()
	{
        global $user;
		if (input::exists()) {
		
				
				$validate = new validate();
				$validation = $validate->check($_POST, array(
					'email' => array(
						'required' => true,
						'unique' => 'users'
					),
					'email_again' => array(
						'required' => true,
						'matches' => 'email'
					)
				));
	
				if ($validation->passed()) {
					
						$user->update(array(
							'email' => escape(input::get('email'))
						));
/* 						 session::flash('home', 'Your password was updated');
                        redirect::to('index.php');  */
                        echo "Email update successfully successful";
					
				} else {
					foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}
				}
				
			
		}
	}

?>
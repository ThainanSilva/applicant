<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL); 
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

if ($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])) {
} else {
}
?>

<head>
    <link rel="stylesheet" type="text/css" href="https://huggingface.co/front/build/style.c01be9164.css">



    <link rel="apple-touch-icon" sizes="180x180" href="/../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/../favicon-16x16.png">
    <link rel="manifest" href="/../site.webmanifest">
    <link rel="mask-icon" href="/../safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
    <title>Nextec - AcessoCloud</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->


    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="../js/jquery.maskedinput.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/locale/bootstrap-table.min.js"></script>

    <script src="../bootstrap\js\bootstrap.min.js"></script>
    <script src="js/notifications.js"></script>
    <script src="js/app.js"></script>
    <script src="../js/bootstrap-confirmation.min.js"></script>

    <!-- put your locale files after bootstrap-table.js -->

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- materializer -->
    <script type="text/javascript" src='js/webcam.js'>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha256-yNbKY1y6h2rbVcQtf0b8lq4a+xpktyFc3pSYoGAY1qQ=" crossorigin="anonymous"></script>

    <!-- materializer -->

    <link rel="shortcut icon" href="favicon.ico" />

</head>

<body>

    <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js">
    </script>

    <header class="border-b border-gray-100">
        <div class="w-full px-4 lg:px-6 xl:container flex items-center h-16">
            <div class="flex flex-1 items-center"><a class="flex flex-none items-center mr-5 lg:mr-6" href="/"><img alt="Hugging Face's logo" class="md:mr-2 w-7" src="https://crm.nextecbrasil.com.br/assets/images/logo-inverse.png" style="
    object-fit: cover; 
    object-position: -37% 0;
    width: 100%;
"> <span class="hidden text-lg font-bold whitespace-nowrap md:block">TalentIA</span></a>
                <div class="relative flex-1 lg:max-w-sm mr-2 sm:mr-4 lg:mr-6"><input autocomplete="off" class="w-full dark:bg-gray-950 pl-8 
			form-input-alt h-9 pr-3 focus:shadow-xl" name="" placeholder="Procure por vagas, candidatos..." spellcheck="false" type="text"> <svg class="absolute left-2.5 text-gray-400 top-1/2 transform -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                        <path d="M30 28.59L22.45 21A11 11 0 1 0 21 22.45L28.59 30zM5 14a9 9 0 1 1 9 9a9 9 0 0 1-9-9z" fill="currentColor"></path>
                    </svg> </div> <button class="lg:hidden relative flex-none place-self-stretch flex items-center justify-center w-8" type="button"><svg class="text-xl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M4 24h24v2H4z"></path>
                        <path d="M4 12h24v2H4z"></path>
                        <path d="M4 18h24v2H4z"></path>
                        <path d="M4 6h24v2H4z"></path>
                    </svg> </button>
            </div>
            <nav aria-label="Main" class="ml-auto hidden lg:block">
                <ul class="flex items-center space-x-2">
                    <li><a class="flex items-center group px-2 py-0.5 dark:hover:text-gray-400 hover:text-indigo-700" href="/models">

                            <i class="uim uim-briefcase" style="margin-right:5px;"></i> Vagas</a></li>
                    <li><a class="flex items-center group px-2 py-0.5 dark:hover:text-gray-400 hover:text-red-700" href="/datasets">
                            <i class="uim uim-user-arrows mr-1.5 text-gray-400 group-hover:text-red-500" style="margin-right:5px;"></i> Candidatos</a></li>
                    <li><a class="flex items-center group px-2 py-0.5 dark:hover:text-gray-400 hover:text-blue-700" href="/spaces"><svg class="mr-1.5 text-gray-400 group-hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" width="1em" height="1em" viewBox="0 0 25 25">
                                <path opacity=".5" d="M6.016 14.674v4.31h4.31v-4.31h-4.31ZM14.674 14.674v4.31h4.31v-4.31h-4.31ZM6.016 6.016v4.31h4.31v-4.31h-4.31Z" fill="currentColor"></path>
                                <path opacity=".75" fill-rule="evenodd" clip-rule="evenodd" d="M3 4.914C3 3.857 3.857 3 4.914 3h6.514c.884 0 1.628.6 1.848 1.414a5.171 5.171 0 0 1 7.31 7.31c.815.22 1.414.964 1.414 1.848v6.514A1.914 1.914 0 0 1 20.086 22H4.914A1.914 1.914 0 0 1 3 20.086V4.914Zm3.016 1.102v4.31h4.31v-4.31h-4.31Zm0 12.968v-4.31h4.31v4.31h-4.31Zm8.658 0v-4.31h4.31v4.31h-4.31Zm0-10.813a2.155 2.155 0 1 1 4.31 0 2.155 2.155 0 0 1-4.31 0Z" fill="currentColor"></path>
                                <path opacity=".25" d="M16.829 6.016a2.155 2.155 0 1 0 0 4.31 2.155 2.155 0 0 0 0-4.31Z" fill="currentColor"></path>
                            </svg> Analises</a></li>
                    <li><a class="flex items-center group px-2 py-0.5 dark:hover:text-gray-400 hover:text-yellow-700" href="/docs"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="mr-1.5 text-gray-400 group-hover:text-yellow-500" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                                <path opacity="0.5" d="M20.9022 5.10334L10.8012 10.8791L7.76318 9.11193C8.07741 8.56791 8.5256 8.11332 9.06512 7.7914L15.9336 3.73907C17.0868 3.08811 18.5002 3.26422 19.6534 3.91519L19.3859 3.73911C19.9253 4.06087 20.5879 4.56025 20.9022 5.10334Z" fill="currentColor"></path>
                                <path d="M10.7999 10.8792V28.5483C10.2136 28.5475 9.63494 28.4139 9.10745 28.1578C8.5429 27.8312 8.074 27.3621 7.74761 26.7975C7.42122 26.2327 7.24878 25.5923 7.24756 24.9402V10.9908C7.25062 10.3319 7.42358 9.68487 7.74973 9.1123L10.7999 10.8792Z" fill="currentColor" fill-opacity="0.75"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.3368 10.8499V6.918C21.3331 6.25959 21.16 5.61234 20.8346 5.03949L10.7971 10.8727L10.8046 10.874L21.3368 10.8499Z" fill="currentColor"></path>
                                <path opacity="0.5" d="M21.7937 10.8488L10.7825 10.8741V28.5486L21.7937 28.5234C23.3344 28.5234 24.5835 27.2743 24.5835 25.7335V13.6387C24.5835 12.0979 23.4365 11.1233 21.7937 10.8488Z" fill="currentColor"></path>
                            </svg> Relatórios</a></li>
                    <li>
                        <div class="relative "><button class="px-2 py-0.5 group hover:text-green-700 dark:hover:text-gray-400 flex items-center
			" type="button"><svg class="mr-1.5 text-gray-400 group-hover:text-green-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path class="uim-tertiary" d="M19 6H5a3 3 0 0 0-3 3v2.72L8.837 14h6.326L22 11.72V9a3 3 0 0 0-3-3z" opacity=".5" fill="currentColor"></path>
                                    <path class="uim-primary" d="M10 6V5h4v1h2V5a2.002 2.002 0 0 0-2-2h-4a2.002 2.002 0 0 0-2 2v1h2zm-1.163 8L2 11.72V18a3.003 3.003 0 0 0 3 3h14a3.003 3.003 0 0 0 3-3v-6.28L15.163 14H8.837z" fill="currentColor"></path>
                                </svg> Soluções </button> </div>
                    </li>
                    <li><a class="flex items-center group px-2 py-0.5 hover:text-gray-500 dark:hover:text-gray-400" href="/pricing" data-ga-category="header-menu" data-ga-action="clicked pricing" data-ga-label="pricing">Planos</a></li>
                    <li>
                        <div class="relative group"><button class="px-2 py-0.5 hover:text-gray-500 dark:hover:text-gray-600 flex items-center
			" type="button"><svg class="mr-1.5 text-gray-500 w-5 group-hover:text-gray-400 dark:text-gray-300 dark:group-hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" width="1em" height="1em" viewBox="0 0 32 18" preserveAspectRatio="xMidYMid meet">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4504 3.30221C14.4504 2.836 14.8284 2.45807 15.2946 2.45807H28.4933C28.9595 2.45807 29.3374 2.836 29.3374 3.30221C29.3374 3.76842 28.9595 4.14635 28.4933 4.14635H15.2946C14.8284 4.14635 14.4504 3.76842 14.4504 3.30221Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4504 9.00002C14.4504 8.53382 14.8284 8.15588 15.2946 8.15588H28.4933C28.9595 8.15588 29.3374 8.53382 29.3374 9.00002C29.3374 9.46623 28.9595 9.84417 28.4933 9.84417H15.2946C14.8284 9.84417 14.4504 9.46623 14.4504 9.00002Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4504 14.6978C14.4504 14.2316 14.8284 13.8537 15.2946 13.8537H28.4933C28.9595 13.8537 29.3374 14.2316 29.3374 14.6978C29.3374 15.164 28.9595 15.542 28.4933 15.542H15.2946C14.8284 15.542 14.4504 15.164 14.4504 14.6978Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.94549 6.87377C2.27514 6.54411 2.80962 6.54411 3.13928 6.87377L6.23458 9.96907L9.32988 6.87377C9.65954 6.54411 10.194 6.54411 10.5237 6.87377C10.8533 7.20343 10.8533 7.73791 10.5237 8.06756L6.23458 12.3567L1.94549 8.06756C1.61583 7.73791 1.61583 7.20343 1.94549 6.87377Z" fill="currentColor"></path>
                                </svg> </button> </div>
                    </li>
                    <li>
                        <hr class="w-0.5 h-5 border-none bg-gray-100 dark:bg-gray-800">
                    </li>
                    <li><a class="px-2 py-0.5 block cursor-pointer hover:text-gray-500 dark:hover:text-gray-400" href="/login">Log In</a></li>
                    <li><a class="ml-2 btn" href="/join">Sign Up</a></li>
                </ul>
            </nav>
        </div>
    </header>



    <div id="contentmanager" class="content">

        <div class="window-spacer">
            <h3>Bem vindo <?php echo $_SESSION['user_name']; ?></h3>

        </div>


    </div>
    <script>
        $(document).ready(function() {

            $('.dropdown-toggle').prop('disabled', true);

        })
    </script>
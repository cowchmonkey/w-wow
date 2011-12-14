<?php
    /**
     * IN AN ATTEMP TO MAKE THE ADDITION OF PAGES FOR THE V-WOW, I DECIDED TO
     * TRY SOMETHING DIFFERENT.
     *
     * THE FOLLOWING IS A LIST OF PAIRED VARIABLES.
     * EACH PAIR IS COMPRISED OF A THREE LETTER(OPTIONAL LENGTH) VARIALBE AND
     * A PAGE NAME (EXCL. EXT).
     * EXAMPLE: ITV, ITEM_VIEW
     *      ITV         = ITEM VIEW
     *
     * TO LINK TO THESE PAGES, USE THE FOLLOWING EXAMPLE:
     *
     * <a href="index.php?pt=[3 letter var]&amp;[user identifier]=[user vars]">Link</a>
     *
     * USING THE ABOVE EXAMPLE:
     * <a href="index.php?pt=itv&amp;id=1234">This Item</a>
     *
     * ONCE YOU HAVE YOUR LINK, YOU WILL HAVE TO ADD THE VARS HERE, THEN CREATE
     * THE MATCHING PAGE. IN THIS CASE ITEM_VIEW.PHP AND SAVE IT.
     *
     * ALL USER VARS ARE HANDLED WITHIN THE PAGE **YOU*** CREATE
     *
     *  RECAP:
     *      1. MAKE YOUR PAGE AND SAVE IT
     *      2. ADD IT TO THE LIST BELOW
     *      3. MAKE YOUR LINK
     *      4. DONE!
     *      
     * ANY QUESTIONS: - KLYXMASTER@GMAIL.COM
     *                - SUBJECT: V-WOW PAGE CREATION
     *
     *  I'LL BE HAPPY TO HELP!
     *  
     **/
    
    //     var          php page  (no ext)
    // =======================================================================
    $page['its']    = 'item_search';
    $page['itv']    = 'item_view';
    $page['qts']    = 'quest_search';
    $page['qsv']    = 'quest_view';
    $page['mbs']    = 'mob_search';
    $page['mbv']    = 'mob_view';
    $page['sps']    = 'spell_search';
    $page['spv']    = 'spell_view';
    
    // TOP MENU
    $page['reg']    = 'registration';
    $page['log']    = 'login';
    $page['who']    = 'whoonline';
    $page['hom']    = 'index';
    //SQL
    $page['sql']    = 'sql_error';
    // LOGIN 
    $page['lge']    = 'login_error';
    $page['aok']    = 'login_success';
    //Construction page
	$page['con']	= 'construction';
	//bot page
	$page['bot']	= 'construction';//change to bot_info later after the page is more complete
?>
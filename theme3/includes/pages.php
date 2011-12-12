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
     *      ITEM_VIEW   = item_view.php (ext added at runtime)
     *
     * TO LINK TO THESE PAGES, USE THE FOLLOWING EXAMPLE:
     *
     * <a href="index.php?pt=[3 letter var]&amp;pp=[php page name]&amp;[user identifier]=[user vars]">Link</a>
     *
     * USING THE ABOVE EXAMPLE:
     * <a href="index.php?pt=itv&amp;pp=item_view&amp;id=1234">This Item</a>
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
    $page['its']    = 'item_search_results';
    $page['itv']    = 'item_view';
    $page['qts']    = 'quest_search_results';
    $page['qtv']    = 'quest_view';
    $page['mbs']    = 'mob_search_results';
    $page['mbv']    = 'mob_view';
    $page['reg']    = 'registration';
    $page['log']    = 'login';
    $page['who']    = 'online';
    $page['hom']    = 'index';
    
?>
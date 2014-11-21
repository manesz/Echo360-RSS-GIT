<div class="col-sm-3 col-md-2 sidebar" style="font-size: 12px;">
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Overview</a></li>
        <li><a href="daily_portfolio.php">Dialy Portfolio</a></li>
        <li><a href="portfolio_target.php">Portfolio</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Export</a></li>
    </ul>
    <?php
        switch(@$_SESSION['user_department']){
            case 1:
                echo '
                    <ul class="nav nav-sidebar">
                        <li style="padding: 10px 0 10px 20px; font-weight: bold; font-size: 14px;">Management Menu:</li>
                        <li><a href="offer_imp_list.php">Offer list</a></li>
                    <li><a href="marketing_score_list.php">Marketing Score list</a></li>
                    </ul>
                ';
                break;
            case 2:
                echo '
                <ul class="nav nav-sidebar">
                    <li style="padding: 10px 0 10px 20px; font-weight: bold; font-size: 14px;">MIS Menu:</li>
                    <li><a href="offer_imp_list.php">Offer list</a></li>
                    <li><a href="marketing_score_list.php">Marketing Score list</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="daily_portfolio_status.php">Account Status</a></li>
                    <li><a href="quota_opportunity.php">Used Opportunity</a></li>
                    <li><a href="customer_update_profile.php">Update profile (Test)</a></li>
                    <li><a href="offer_clear_blacklist.php">Clear Blacklist</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="call_stat.php">View Call Stat</a></li>
                    <li><a href="offer_completion_rate.php">Offer Completion Rate</a></li>
                </ul>
                ';
                break;
            case 3:
                echo '
                <ul class="nav nav-sidebar">
                    <li style="padding: 10px 0 10px 20px; font-weight: bold; font-size: 14px;">Operation Menu:</li>
                    <li><a href="offer_imp_list.php">Offer list</a></li>
                    <li><a href="marketing_score_list.php">Marketing Score list</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="customer_update_profile.php">Update profile (Test)</a></li>
                    <li><a href="offer_update_limit.php">Update Offer Limit</a></li>
                    <li><a href="offer_clear_blacklist.php">Clear Blacklist</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="offer_completion_rate.php">Offer Completion Rate</a></li>
                    <li><a href="contact_history.php">Call History (TEST)</a></li>
                </ul>
                ';
                break;
            case 4:
                echo '
                <ul class="nav nav-sidebar">
                    <li style="padding: 10px 0 10px 20px; font-weight: bold; font-size: 14px;">Sale Menu:</li>
                    <li><a href="offer_imp_list.php">Offer list</a></li>
                </ul>
                ';
                break;
            case 5:
                echo '
                <ul class="nav nav-sidebar">
                    <li style="padding: 10px 0 10px 20px; font-weight: bold; font-size: 14px;">Administrator Menu:</li>
                    <li><a href="offer_imp_list.php">Offer list</a></li>
                    <li><a href="account_list.php">Account list</a></li>
                    <li><a href="marketing_score_list.php">Marketing Score list</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="daily_portfolio_status.php">Account Status</a></li>
                    <li><a href="quota_opportunity.php">Used Opportunity</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="customer_update_profile.php">Update profile (Test)</a></li>
                    <li><a href="offer_update_limit.php">Update Offer Limit</a></li>
                    <li><a href="offer_clear_blacklist.php">Clear Blacklist</a></li>
                    <li><a href="call_stat.php">View Call Stat</a></li>
                    <li><a href="offer_completion_rate.php">Offer Completion Rate</a></li>
                    <li><a href="contact_history.php">Call History (TEST)</a></li>
                    <li class="diver"><hr/></li>
                    <li><a href="user_list.php">User list</a></li>
                    <li><a href="log.php">Log History</a></li>
                </ul>
                ';
                break;
            default:
                null;
                break;
        }//END: switch menu case
    ?>
    <ul class="nav nav-sidebar">
        <li class="diver"><hr/></li>
        <li><a href="user_edit.php?id=<?php echo @$_SESSION['user_id']; ?>">Profile</a></li>
        <li><a href="#">Help</a></li>
        <li style=" border-bottom: 1px #000 solid;"><a href="functions.php?action=signout" style="font-weight: bold; font-size: 18px; color: #000;"><span>SIGNOUT</span></a></li>
    </ul>

</div>
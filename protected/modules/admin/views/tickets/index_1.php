<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/huongminh_ticket.css" />
<div class="digital_ticket">
    <header>
        <span class="icon"></span>
        <h1 class="border_none">Support</h1>
        <div class="button-group"><a data-toggle="collapse" data-focus="#ticket_topic" class="button" href="#new_ticket">New Ticket</a>
        </div>
    </header>
    
<div id="new_ticket" class="in collapse" style="height: auto;">
    <form method="post" id="new_ticket" data-validate="true" class="new_ticket" action="/tickets" accept-charset="UTF-8">
        <div style="margin:0;padding:0;display:inline">
                <input type="hidden" value="✓" name="utf8">            
        </div>
        <fieldset>
            <div id="ticket_topic_field">    
                <input type="text" title="" size="30" placeholder="Subject" name="ticket[topic]" id="ticket_topic" data-validation="required" data-suggest="true" data-original-title="Please provide a subject for the ticket." class="invalid">
            </div>
            <div class="styled-select">
                <select name="ticket[droplet_id]" id="ticket_droplet_id"><option value="">Affected Droplet</option>
                <option value="1179238">daukhimiennam.com.sg</option>
                </select>
            </div>
            <textarea rows="20" placeholder="Please detail your issue or question..." name="ticket[content]" id="ticket_content" cols="40"></textarea>
            <input type="submit" value="Create Ticket" name="commit" class="button">
        </fieldset>
    </form>
</div>    
<h2 class="section-header open_tickets">Open Tickets</h2>
    
<ul class="tickets">
<li class="ticket">
<div class="content">
<h4 class="title"><a data-toggle="collapse" class="view collapsed" href="#ticket-336774">About billing</a></h4>
<div class="actions">
<a data-toggle="collapse" class="reply collapsed" href="#ticket-336774">Reply</a>
<form method="post" class="button_to" action="/support/close_ticket/336774"><div><input type="submit" value="Close" class="btn close"><input type="hidden" value="WCw4BXXy+W3gYSLmEfOXxt2J/UpDgcorN+CQcFlRh14=" name="authenticity_token"></div></form>
</div>
<p class="created_at">
Ticket #<strong title="" data-toggle="tooltip" data-original-title="This is your ticket identification number">336774</strong> 
- Created on 
08/06/14 at 22:06 UTC
- Last reply 1 Day ago by 
<span class="label">jmarhee</span>
</p>
</div>
<div id="ticket-336774" class="collapse">
<div class="post_reply">
<h4>Post Reply</h4>
<div class="styled-form">
<form novalidate="novalidate" method="post" id="new_reply" class="simple_form new_reply" action="/tickets/336774/replies" accept-charset="UTF-8"><div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="WCw4BXXy+W3gYSLmEfOXxt2J/UpDgcorN+CQcFlRh14=" name="authenticity_token"></div><div class="control-group text required reply_content"><div class="controls"><textarea rows="20" placeholder="Enter your message here" name="reply[content]" id="reply_content" cols="40" class="text required"></textarea></div></div>
<input type="submit" value="Submit Reply" name="commit">
</form>

</div>

</div>
<ul class="replies">
<li class="received reply">
<div class="message">
<p>Hello,</p>

<p>If you use PayPal, and you run a $5/month droplet, for example, you need to maintain a balance of $5. If you have two of them, then your balance in this example would need to be $10.</p>

<p>Does that clarify the policy for you? Please let us know if any of this is unclear.</p>

<p>Thanks,
<br>DigitalOcean Support  
<br>Check out our community for helpful articles and tutorials.  
<br>https://digitalocean.com/community</p>

<p></p>
<span class="posted_on">
Posted on 
08/06/14 at 22:37 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/c2da17c95e66c07894e30584b34a9921?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Jmarhee</span>
</div>
</li>
<li class="reply sent">
<div class="message">
<p>Meaning my credit  can run negative, and i will pay with paypal later?</p>
<span class="posted_on">
Posted on 
08/06/14 at 22:24 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/32cab4602a7c093991e497352eabdcb3?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Nguyendungww</span>
</div>
</li>
<li class="received reply">
<div class="message">
<p>Hello,</p>

<p>When you use PayPal as your payment method, payments are not recurring.  It functions more as a "pay-as-you-go" or "pre-pay" service.  This means we expect that you would keep a credit balance in your account at all times ahead of the usage.</p>

<p>Once you start to run low on funds or owe money, the system will start mailing you notifications periodically until payment is made.</p>

<p>Let us know if you need anything else.</p>

<p>Thanks,
<br>Tyler
<br>DigitalOcean Support
<br>https://digitalocean.com/community  </p>
<span class="posted_on">
Posted on 
08/06/14 at 22:18 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/13997bffdcb165476d978d9affc460ac?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Tyler</span>
</div>
</li>
<li class="reply sent">
<div class="message">
<p>it's my credit = 0, my droplet will stop immediate? </p>
<span class="posted_on">
Posted on 
08/06/14 at 22:13 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/32cab4602a7c093991e497352eabdcb3?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Nguyendungww</span>
</div>
</li>
<li class="received reply">
<div class="message">
<p>Hello,</p>

<p>Could you clarify your question? A balance of 0 (or a credit, which you have for $1.83) will suffice to keep your droplets from being powered off.</p>

<p>Thanks,
<br>DigitalOcean Support  
<br>Check out our community for helpful articles and tutorials.  
<br>https://digitalocean.com/community</p>

<p></p>
<span class="posted_on">
Posted on 
08/06/14 at 22:11 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/c2da17c95e66c07894e30584b34a9921?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Jmarhee</span>
</div>
</li>
<li class="reply sent">
<div class="message">
<p>If my Balance = 0 then my droplet will stop immediate?
<br>It can run some day more, when i pay late</p>
<span class="posted_on">
Posted on 
08/06/14 at 22:06 UTC
</span>
</div>
<div class="author">
<img width="90" height="90" src="https://secure.gravatar.com/avatar/32cab4602a7c093991e497352eabdcb3?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">
<span class="name">Nguyendungww</span>
</div>
</li>
</ul>

</div>

</li>
</ul>    
    
</div>    
<?php
class NewsletterCommand extends CConsoleCommand
{
    protected $max = 10;
    protected $index = 0;
    protected $data = array();

    public function run($arg)
    {
        return;
//        echo 'Test cron /nnnn ---/n';
//        Yii::log("Test cron");
        Yii::app()->setting->setDbItem('last_working', date('Y-m-d H:i:s'));
        return ;
        if(Yii::app()->params['mailchimp_on'] == 'yes')
            return;        
        $last_working = Yii::app()->setting->getItem('last_working');
        if(!empty($last_working))
        {
            $timestampNext = strtotime(ActiveRecord::timeCalMinutes(-10));
            if(strtotime($last_working) > $timestampNext)
            {
//                Yii::log(strtotime($last_working), 'error', 'NewsletterCommand.run');
//                Yii::log($timestampNext, 'error', 'NewsletterCommand.run');
                echo 'waiting because last working is nearly';
                return;
            }
        }
        $this->doJob($arg);
        CmsEmail::mailAll($this->data);
        echo "Sent {$this->index} emails";
        Yii::app()->setting->setDbItem('last_working', date('Y-m-d H:i:s'));
    }

    protected function doJob($arg)
    {
        $model = Newsletter::model()->find(array(
            'condition'=>'t.remain_subscribers IS NOT NULL AND length(t.remain_subscribers) > 0 AND t.send_time <= NOW()',
            'order'=>'t.id ASC',
        ));

        if($model !== null)
        {
            $subscriber_count = 0;
            $receivers = explode(',', $model->remain_subscribers);
            while(count($receivers) > 0)
            {
                $k = array_shift($receivers);
                if(empty($k)) continue; // add by Nguyen Dung
                $s = Subscriber::model()->findByPk($k);                
                if($s)
                    if($s->status==0) continue; // add by Nguyen Dung

                $url=Yii::app()->setting->getItem('server_name').'/site/track_newsletter?newsletter_id='.$model->id.'&subscriber_email='.$s->email;
                $img_track_read_email = '<img src="'.$url.'" alt="" height="1" width="1"/>';
                $r = array(
                    'subject'=>$model->subject,
                    'params'=>array(
                        'content'=>$model->content.$img_track_read_email,
                        'newsletterName'=> 'Verzdesign',
                        'unsubscribe'=> Yii::app()->setting->getItem('server_name').'/site/unsubscribe?id='.$s->id.'&code='.md5($s->id.$s->email),
                    ),
                    'view'=>'newsletter',
                    'to'=>$s->email,
                    'from'=>Yii::app()->params['autoEmail'],
                );
                
                $this->data []= $r;
                $subscriber_count++;//count subscriber is served for current newsletter job
                $this->index++;//count email is sent for current cron job
                if($this->index >= $this->max)
                    break;                
            }
            
            $model->total_sent = $model->total_sent+$subscriber_count; // track amount mail sent
            $model->remain_subscribers = implode(',', $receivers);
            $model->update(array('remain_subscribers','total_sent'));
        }
        else
        {
            return;
        }

        //when sent all subscriber of a newsletter job but the
        if($this->index < $this->max)
            $this->doJob($arg);
    }
}
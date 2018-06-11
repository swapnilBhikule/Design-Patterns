<?php


interface Observable
{
    /**
     * Add new observer in the list
     *
     * @param   Observer $observer
     * @return  void
     */
    public function addObserver(Observer $observer);

    /**
     * Remove given observer from the list
     *
     * @param   Observer $observer
     * @return  void
     */
    public function removeObserver(Observer $observer);

    /**
     * Return true if the security is actually breached to avoid false trigger
     *
     * @return bool
     */
    public function isChanged();
}

class SecurityBreatch implements Observable
{
    private $observers;
    private $is_changed = false;
    private $message    = 'Security breach at headquarters';

    /**
     * Add new observer in the list
     *
     * @param   Observer $observer
     * @return  void
     */
    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * Remove given observer from the list
     *
     * @param   Observer $observer
     * @return  void
     */
    public function removeObserver(Observer $observer)
    {
        $key = array_search($observer, $this->observers);

        if ($key) {
            unset($this->observers[$key]);
        }
    }

    /**
     * Return true if the security is actually breached to avoid false trigger
     *
     * @return bool
     */
    public function isChanged()
    {
        return $this->is_changed;
    }

    /**
     * Getter method to return the breach message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Continuously check for breach(may be via cron job), if breach happens notify
     * all registered observers about the breach
     *
     * @return void
     */
    public function breach()
    {
        // get securiy notification to check if security is as expected
        // if not
        $this->is_changed = true;
        $this->notify();
        $this->is_changed = false;
    }

    /**
     * Notifiy(call) all registered observers about the breach
     *
     * @return void
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}


interface Observer
{
    /**
     * Update the securiy status
     *
     * @param   Observable $observable
     * @return  void
     */
    public function update(Observable $observable);
}

class EmailObserver implements Observer
{
    /**
     * Notify system admin(s) about the security breach via email notification
     *
     * @param   Observable $observable
     * @return  void
     */
    public function update(Observable $observable)
    {
        if ($observable->isChanged()) {
            // send email notification to security head
            echo "Security breach notification via email - " . $observable->getMessage() . " \n";
        }
    }

    // Other methods like sending actual emails etc.
}

class SMSObserver implements Observer
{
    /**
     * Notify system admin(s) about the security breach via sms notification
     *
     * @param   Observable $observable
     * @return  void
     */
    public function update(Observable $observable)
    {
        if ($observable->isChanged()) {
            // send sms notification to security head
            echo "Security breach notification via sms - " . $observable->getMessage() . " \n";
        }
    }

    // Other methods like sending actual sms etc.
}


$subject = new SecurityBreatch;

$email_notifier = new EmailObserver;
$sms_notifier = new SMSObserver;

$subject->addObserver($email_notifier);
$subject->addObserver($sms_notifier);

$subject->breach();

echo "\n \n";
echo "---------- AFTER REMOVING SMSObserver FROM THE LIST ---------- \n";
echo "\n \n";
$subject->removeObserver($sms_notifier);

$subject->breach();
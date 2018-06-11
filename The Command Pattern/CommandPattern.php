<?php

/**
 * When user logs in they we want to send a security mail to his address
 * saying that someone has logged into his account. To keep record of
 * logged in users, john want to store log file with timestamp of user's
 * log in time.
 */
class UserLoggedIn
{
    /**
     * Send a security mail to logged in user's email address
     *
     * @return void
     */
    public function sendLoggedInMail()
    {
        echo "Sending security information to user \n";
    }

    /**
     * Add log in record to log for future analytics.
     *
     * @return void
     */
    public function addLog()
    {
        echo "User logged in at " . date('Y-m-d H:i:s') . "\n";
    }
}

/**
 * When user logs off, john want us to store log with timestamp to calculate
 * average time spend by a logged in user to his website.
 */
class UserLoggedOut
{
    /**
     * Add log out record to log for future analytics.
     *
     * @return void
     */
    public function addLog()
    {
        echo "User logged out at " . date('Y-m-d H:i:s') . "\n";
    }
}

/**
 * When a new user register to the website John want to send verification email
 * to newly registered user. He himself want to get "new user added" notification
 * and store the log for future analytics.
 */
class UserRegistered
{
    /**
     * Send a verification email to newly registered user's email
     *
     * @return void
     */
    public function sendVerificationMail()
    {
        echo "Please verify your email address \n";
    }

    /**
     * Send notification email to admin(John)
     *
     * @return void
     */
    public function sendAdminEmail()
    {
        echo "New user registered to the system \n";
    }

    /**
     * Add new user added record to log for future analytics.
     *
     * @return void
     */
    public function addLog()
    {
        echo "New user registered at " . date('Y-m-d H:i:s') . "\n";
    }
}

/**
 * This is the invoker. What John wanted us to build. A clean class just aware
 * of knowledge of executing provided command. It should not have any knowledge
 * of vendor class and which of the methods of vendor class are getting executed.
 *
 * Since all concrete Commands implementing Command interface so the Event class
 * is aware of a fact that all concrete Commands classes will have "execute"
 * method.
 */
class Invoker
{
    protected $command;

    /**
     * Save given command object to class property
     *
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Execute provided command
     *
     * @return void
     */
    public function dispatch()
    {
        $this->command->execute();
    }
}

/**
 * Command interface. It is consist of single method, execute. This method will
 * take care of actual vendor class's execution.
 */
interface Command
{
    public function execute();
}

/**
 * Command class for UserLoggedIn Event.
 */
class UserLoggedInCommand implements Command
{
    protected $vendor;

    /**
     * Store UserLoggedIn object to class's property.
     *
     * @param UserLoggedIn $vendor
     */
    public function __construct(UserLoggedIn $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Execute necessary methods of UserLoggedIn class
     *
     * @return void
     */
    public function execute()
    {
        $this->vendor->sendLoggedInMail();
        $this->vendor->addLog();
    }
}

/**
 * Command class for UserLoggedOut Event.
 */
class UserLoggedOutCommand implements Command
{
    protected $vendor;

    /**
     * Store UserLoggedOut object to class's property.
     *
     * @param UserLoggedOut $vendor
     */
    public function __construct(UserLoggedOut $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Execute necessary methods of UserLoggedOut class
     *
     * @return void
     */
    public function execute()
    {
        $this->vendor->addLog();
    }
}

/**
 * Command class for UserRegistered Event.
 */
class UserRegisteredCommand implements Command
{
    protected $vendor;

    /**
     * Store UserLoggedOut object to class's property.
     *
     * @param UserRegistered $vendor
     */
    public function __construct(UserRegistered $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Execute necessary methods of UserRegistered class
     *
     * @return void
     */
    public function execute()
    {
        $this->vendor->sendVerificationMail();
        $this->vendor->sendAdminEmail();
        $this->vendor->addLog();
    }
}

// Added extension to the command pattern

/**
 * This command class is known as Macro Command. It's responsibility is to execute
 * multiple commands when a client call it's execute method.
 */
class MacroCommand implements Command
{
    protected $commands = [];

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function execute()
    {
        foreach ($this->commands as $command)
        {
            $command->execute();
        }
    }
}


/**
 * First, we will create object of concrete Event/Vendor classes.
 */
$logged_in = new UserLoggedIn;
$logged_out = new UserLoggedOut;
$registered = new UserRegistered;

/**
 * Then we can create their respective concrete command classes by passing
 * corresponding object into their constructor.
 */
$registered_command = new UserRegisteredCommand($registered);
$logged_in_command = new UserLoggedInCommand($logged_in);
$logged_out_command = new UserLoggedOutCommand($logged_out);

/**
 * Suppose John's website having a feature that the site register the new user
 * and immidiately log him in. Then we might want to use our flexible MacroCommand Class.
 * We will add respective concrete command class objects i.e. UserRegistered and UserLoggedIn
 * and this class will execute both of them.
 */
$macro_command = new MacroCommand([$registered_command, $logged_in_command]);

/**
 * Finally, we will pass command object to the Invoker class's constructor and we will
 * execute the dispatch method.
 */

echo "----------------------- WITH MACRO COMMAND ----------------------- \n";
$invoker = new Invoker($macro_command);
$invoker->dispatch();

echo "----------------------- WITHOUT MACRO COMMAND ----------------------- \n";
$invoker = new Invoker($logged_out_command);
$invoker->dispatch();
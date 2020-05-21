    <?php
    class Manager
    {
        protected $_listUsers = [];


        public function addUsers($users)
        {
            foreach ($users as $user) {
                $this->_listUsers[] = new User($user[0], $user[1], $user[2]);
            }
            return $this;
        }
        
        public function showUserNormal()
        {           
            usort($this->_listUsers, function ($a, $b) {
                return $a->getName() <= $b->getName();
            });
            var_dump($this->_listUsers);
            echo '<br><br>';
        }

        function showUserHard()
        {
            usort($this->_listUsers, function($a,$b){
                $retval = $a->getName()<=$b->getName();
                if ($retval == 0) {
                    $retval = $a->getBirthday()<= $b->getBirthday();
                } if ($retval ==0){
                    $retval = $a->getScore() <= $b->getScore();
                }
                return $retval;
            });
            var_dump($this->_listUsers);
        }
    }

    class User
    {
        protected $name;
        protected $birth_day;
        protected $score;
        // function __construct($name, $birth_day, $score)
        // {
        //     $this->name = $name;
        //     $this->birth_day = $birth_day;
        //     $this->score = $score;
        // }
        function getName()
        {
            return $this->name;
        }
        function setName($name)
        {
            $this->name = $name;
        }

        function getBirthday()
        {
            return $this->birth_day;
        }
        function setBirthday($birth_day)
        {
            $this->birth_day = $birth_day;
        }

        function getScore()
        {
            return $this->score;
        }
        function setScore($score)
        {
            $this->score = $score;
        }
    }
    $users = [
        ['a', '05-12-2000', '100'],
        ['b', '05-12-2001', '100'],
        ['c', '05-12-2000', '99'],
        ['b', '05-12-2000', '99'],
        ['d', '05-12-1999', '98']
    ];
    $manager = new Manager();
    $manager->addUsers($users);
    $manager->showUserNormal();
    $manager->showUserHard();


    ?>
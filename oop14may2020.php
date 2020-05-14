<!-- "Bài 1: Nhập danh sách n học sinh viết dưới dạng các thuộc tính: họ tên, năm sinh và tổng điểm.
=>(Normal) Sắp xếp theo thứ tự giảm dần của tổng điểm. 
Khi tổng điểm như nhau thì học sinh có năm sinh nhỏ hơn được đứng trước. 
In ra danh sách học sinh đã sắp xếp sao cho tất cả các chữ cái đầu của họ tên chuyển thành chữ hoa.
=> (Hard) Sắp xếp theo name rồi theo birth_day rồi theo score
$users = [
  ['name' => 'A', 'birth_day' => '05-12-2000', 'score' => 100],
  ['name' => 'X', 'birth_day' => '05-12-2000', 'score' => 100],
  ['name' => 'Y', 'birth_day' => '05-12-2000', 'score' => 99],
  ['name' => 'Z', 'birth_day' => '05-12-1999', 'score' => 98]
];
// Yêu cầu sử dụng class User, class Manager
Cấu trúc mẫu:
class Manager {
    function addUser() {
        // todo
    }
    function showUserNormal() {
        //
    }
    function showUserHard() {
        //
    }
}

class User {
    
}" -->
<?php
class Manager
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
    // function getName () {
    //     return $this->name;
    //   }
    // function setName($name)
    // {
    //     $this->$name = $name;
    // }

    // function getBirthday()
    // {
    //     return $this->birth_day;
    // }
    // function setBirthday($birth_day)
    // {
    //     $this->$birth_day = $birth_day;
    // }

    // function getScore()
    // {
    //     return $this->score;
    // }
    // function setScore($score)
    // {
    //     $this->$score = $score;
    // }

    function addUser($name, $birth_day, $score)
    {
        $this->name = $name;
        $this->birth_day = $birth_day;
        $this->score = $score;
    }
}

class User extends Manager
{
    function __construct($name, $birth_day, $score)
    {
        $this->addUser($name, $birth_day, $score);
    }
    function showUserNormal()
    {
    }

    function showUserHard()
    {
    }
}
$users[] = new User('a', '05-12-2000', '100');
$users[] = new User('b', '05-12-2000', '100');
$users[] = new User('c', '05-12-2000', '99');
$users[] = new User('d', '05-12-1999', '98');

function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

usort($users, build_sorter('score'));

?>
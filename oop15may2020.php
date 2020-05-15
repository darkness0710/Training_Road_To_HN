<!-- "Các thí sinh dự thi đại học bao gồm các thí sinh thi khối A, thí sinh thi khối B, thí sinh thi khối C

Các thí sinh cần quản lý các thuộc tính: Số báo danh, họ tên, địa chỉ, ưu tiên.
Thí sinh thi khối A thi các môn: Toán, lý, hoá
Thí sinh thi khối B thi các môn: Toán, Hoá, Sinh
Thí sinh thi khối C thi các môn: Văn, Sử, Địa
Xây dựng các lớp để quản lý các thí sinh sao cho sử dụng lại được nhiều nhất.
Xây dựng lớp TuyenSinh cài đặt các phương thức thực hiện các nhiệm vụ sau:
Nhập thông tin về các thí sinh dự thi
Hiển thị thông tin về các thí sinh đã trúng tuyển 
(Giả sử điểm chuẩn cho khối A: 15, điểm chuẩn khối B: 16, điểm chuẩn khối C: 13,5).
Tìm kiếm các thí sinh theo số báo danh
Kết thúc chương trình." -->
<?php
class Khoi
{   
    protected $khoi;
    protected $_diem1;
    protected $_diem2;
    protected $_diem3;
    
    public function __construct()
    {
        
    }
    public function setKhoi($_khoi)
    {
        $this->khoi = $_khoi;

        return $this;
    }

    public function getKhoi()
    {
        return $this->khoi;
    }public function setDiem1($_diem1)
    {
        $this->diem1 = $_diem1;

        return $this;
    }

    public function getDiem1()
    {
        return $this->diem1;
    }
    public function setDiem2($_diem2)
    {
        $this->diem2 = $_diem2;

        return $this;
    }

    public function getDiem2()
    {
        return $this->diem2;
    }
    public function setDiem3($_diem3)
    {
        $this->diem3 = $_diem3;

        return $this;
    }

    public function getDiem3()
    {
        return $this->diem3;
    }

}

class ThiSinh extends Khoi
{
    
    protected $sbd;
    protected $name;
    protected $add;
    protected $bonus;

    function __construct($sbd, $name, $add, $bonus)
    {
        $this->sbd = $sbd;
        $this->name = $name;
        $this->add = $add;
        $this->bonus = $bonus;
    }
    function getSbd()
    {
        return $this->sbd;
    }
    function setSbd($sbd)
    {
        $this->sbd = $sbd;
    }
    function getName()
    {
        return $this->name;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function getAdd()
    {
        return $this->add;
    }
    function setAdd($add)
    {
        $this->add = $add;
    }
    function getBonus()
    {
        return $this->bonus;
    }
    function setBonus($bonus) 
    {
        $this->bonus = $bonus;
    }

}
class TuyenSinh{
    protected $_listThiSinh;
    function __construct()
    {
        
    }
    public function add($thiSinh)
    {
        foreach ($thiSinh as $ts){
                $this->_listThiSinh[] = new ThiSinh($ts[0],$ts[1],$ts[2],$ts[3],$ts[4],$ts[5],$ts[6],$ts[7]);
        }
        var_dump($this->_listThiSinh);
    }
    public function show()
    {
        var_dump($this->_listThiSinh);
    }
}

$thiSinh=[134,'nguyen van A','13a 3b',0.4,'Khoi B',6,6,5];
$tuyenSinh = new TuyenSinh();
$tuyenSinh->add($thiSinh);
// $tuyenSinh->show();
?>
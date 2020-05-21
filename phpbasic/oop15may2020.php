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
    protected $_khoi;
    protected $_diem1;
    protected $_diem2;
    protected $_diem3;
    const BAR_A = 15;
    const BAR_B = 16;
    const BAR_C = 13.5;

    public function __construct($khoi, $diem1, $diem2, $diem3)
    {
        $this->_khoi = $khoi;
        $this->_diem1 = $diem1;
        $this->_diem2 = $diem2;
        $this->_diem3 = $diem3;
    }
    public function setKhoi($khoi)
    {
        $this->_khoi = $khoi;
    }

    public function getKhoi()
    {
        return $this->_khoi;
    }
    public function setDiem1($diem1)
    {
        $this->_diem1 = $diem1;
    }

    public function getDiem1()
    {
        return $this->_diem1;
    }
    public function setDiem2($diem2)
    {
        $this->_diem2 = $diem2;
    }

    public function getDiem2()
    {
        return $this->_diem2;
    }
    public function setDiem3($diem3)
    {
        $this->_diem3 = $diem3;
    }

    public function getDiem3()
    {
        return $this->_diem3;
    }
}

class ThiSinh extends Khoi
{

    protected $_sbd;
    protected $_name;
    protected $_addr;
    protected $_bonus;

    function __construct($sbd, $name, $addr, $bonus, $khoi, $diem1, $diem2, $diem3)
    {
        $this->_sbd = $sbd;
        $this->_name = $name;
        $this->_addr = $addr;
        $this->_bonus = $bonus;
        $this->_khoi = $khoi;
        $this->_diem1 = $diem1;
        $this->_diem2 = $diem2;
        $this->_diem3 = $diem3;
    }
    function getSbd()
    {
        return $this->_sbd;
    }
    function setSbd($sbd)
    {
        $this->_sbd = $sbd;
    }
    function getName()
    {
        return $this->_name;
    }
    function setName($name)
    {
        $this->_name = $name;
    }
    function getAddr()
    {
        return $this->_addr;
    }
    function setAddr($addr)
    {
        $this->_addr = $addr;
    }
    function getBonus()
    {
        return $this->_bonus;
    }
    function setBonus($bonus)
    {
        $this->_bonus = $bonus;
    }
}
class TuyenSinh
{
    protected $_danhSachThiSinh = [];
    function __construct()
    {
    }
    public function add($thiSinh)
    {
        foreach ($thiSinh as $ts) {
            $this->_danhSachThiSinh[] = new ThiSinh($ts[0], $ts[1], $ts[2], $ts[3], $ts[4], $ts[5], $ts[6], $ts[7]); //
        }
        return $this;
    }
    public function show()
    {
        $result = array();
        foreach ($this->_danhSachThiSinh as $index => $ts) {

            switch ($ts->getKhoi()) {
                case 'A':
                    if ($ts->getDiem1() + $ts->getDiem2() + $ts->getDiem3() + $ts->getBonus() >= Khoi::BAR_A) {
                        $result[] = $this->_danhSachThiSinh[$index];
                    }
                    break;
                case 'B':
                    if ($ts->getDiem1() + $ts->getDiem2() + $ts->getDiem3() + $ts->getBonus() >= Khoi::BAR_B) {
                        $result[] = $this->_danhSachThiSinh[$index];
                    }
                    break;
                case 'C':
                    if ($ts->getDiem1() + $ts->getDiem2() + $ts->getDiem3() + $ts->getBonus() >= Khoi::BAR_C) {
                        $result[] = $this->_danhSachThiSinh[$index];
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
        print_r($result);
            return $this;
    }
    public function search($query)
    {
        // print_r($this->_danhsachThiSinh);
        $result = array();
        foreach ($this->_danhSachThiSinh as $key => $ts) {
            if (stristr($ts->getName(), $query)) {
                $result[] = $this->_danhSachThiSinh[$key];
            }
        }
        print_r($result);
        return $this;
    }
}
$thiSinh = [
    [134, 'nguyen van A', '13a 3b', 0.4, 'C', 6, 7, 6],
    [133, 'le van B', '65 65', 0, 'A', 8, 8, 8]
];
$tuyenSinh = new TuyenSinh();
$tuyenSinh->add($thiSinh);
$tuyenSinh->show();
$tuyenSinh->search('B');
?>
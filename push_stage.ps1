param (
    [Parameter(Mandatory=$true)]
    [ValidateRange(1, 10)]
    [int]$Stage
)

$stages = @(
    @{ Stage = 1;  Hash = "e603816"; Name = "Giai đoạn 1: Khởi tạo MVC, Assets & Gitignore" },
    @{ Stage = 2;  Hash = "03c162d"; Name = "Giai đoạn 2: CSDL duan1.sql, sơ đồ ERD & kết nối PDO" },
    @{ Stage = 3;  Hash = "96381f7"; Name = "Giai đoạn 3: Router chính, Header, Footer & Trang tĩnh" },
    @{ Stage = 4;  Hash = "2e1ee3a"; Name = "Giai đoạn 4: Danh mục, bộ lọc & chi tiết sản phẩm" },
    @{ Stage = 5;  Hash = "81e3d48"; Name = "Giai đoạn 5: Đăng ký, đăng nhập & quản lý User" },
    @{ Stage = 6;  Hash = "f72fb2c"; Name = "Giai đoạn 6: Giỏ hàng Session & Đặt hàng/Thanh toán" },
    @{ Stage = 7;  Hash = "6da7c7e"; Name = "Giai đoạn 7: Bình luận/Đánh giá & Tìm kiếm sản phẩm" },
    @{ Stage = 8;  Hash = "a74aa4d"; Name = "Giai đoạn 8: Admin Dashboard, phân quyền & bảo mật" },
    @{ Stage = 9;  Hash = "7acd399"; Name = "Giai đoạn 9: CRUD Quản trị (Danh mục, Hàng hóa, Khách hàng, Bình luận)" },
    @{ Stage = 10; Hash = "aecddf3"; Name = "Giai đoạn 10: Hoàn thiện README & Tài liệu dự án" }
)

$target = $stages | Where-Object { $_.Stage -eq $Stage }

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "Dang cap nhat len GitHub den: $($target.Name)" -ForegroundColor Yellow
Write-Host "Commit Hash: $($target.Hash)" -ForegroundColor Yellow
Write-Host "==================================================" -ForegroundColor Cyan

git checkout main
git reset --hard $target.Hash
git push origin main

if ($LASTEXITCODE -eq 0) {
    Write-Host "`n>>> THANH CONG! GitHub da duoc cap nhat den $($target.Name)!" -ForegroundColor Green
} else {
    Write-Host "`n>>> Co loi xay ra khi push, vui long kiem tra lai ket noi." -ForegroundColor Red
}

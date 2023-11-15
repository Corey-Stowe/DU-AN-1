<?php
if(is_array($data)){
    extract($data);
}
?>
<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto">
                                        <div class="card adaptable-card">
                                            <div class="card-body">
                                                <div class="lg:flex items-center justify-between mb-4">
                                                    <h3 class="mb-4 lg:mb-0">Danh sách sản phẩm đã xóa</h3>
                                                </div>
                                                <div class="overflow-x-auto">
                                                    <table id="product-list-data-table" class="table-default table-hover data-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên sản Phẩm</th>
                                                                <th>Loại Hàng</th>
                                                                <th>Số Lượng</th>
                                                                <th>Lượt Xem</th>
                                                                <th>Trạng Thái</th>
                                                                <th>Giá Gốc</th>
                                                                <th>Giá Khuyến Mại</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                           foreach($data as $key => $value){
                                                            extract($value);
                                                           ?>
                                                             <tr>
                                                                <td>
                                                                    <div class="flex items-center">
                                                                        <span class="avatar avatar-rounded avatar-md">
                                                                            <img class="avatar-img avatar-rounded" src="../image/<?php echo $anh?>" loading="lazy">
                                                                        </span>
                                                                        <span class="ml-2 rtl:mr-2 font-semibold"><?php echo $ten_san_pham?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span class="capitalize"><?php echo $ten_loai?></span>
                                                                </td>
                                                                <td><?php  echo $so_luong ?></td>
                                                                <td><?php  echo $luot_xem ?></td>
                                                                <td>
                                                                    <div class="flex items-center gap-2">
                                                                        
                                                                        <?php 
                                                                        if($so_luong >= 1){
                                                                            echo '<span class="badge-dot bg-emerald-500"></span>';
                                                                            echo '<span class="capitalize font-semibold text-emerald-500">Còn Hàng</span>';
                                                                        }else{
                                                                            echo '<span class="badge-dot bg-red-500"></span>';
                                                                            echo '<span class="capitalize font-semibold text-red-500">Hết Hàng</span>';
                                                                        }   
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span><?php echo number_format($don_gia, 0, ',', '.').'đ' ?></span>
                                                                </td>
                                                                <td>
                                                                    <span><?php echo number_format($giam_gia, 0, ',', '.').'đ' ?></span>
                                                                </td>
                                                                <td>
                                                                    <div class="flex justify-end text-lg">
                                                                        <span class="cursor-pointer p-2 hover:text-indigo-600">
                                                                        <a href="admin.php?act=recoversp&ma_san_pham=<?php echo $ma_san_pham ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  aria-hidden="true" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
                                                                        </svg>
                                                                        </a>

                                                                        </span>
                                                                        <span class="cursor-pointer p-2 hover:text-indigo-600">
                                                                          <a href="admin.php?act=editsp&ma_san_pham=<?php echo $ma_san_pham ?>">
                                                                          <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                                            </svg>
                                                                          </a>
                                                                        </span>
                                                                        <span class="cursor-pointer p-2 hover:text-red-500">
                                                                        <a href="admin.php?act=delsp&ma_san_pham=<?php echo $ma_san_pham ?>">
                                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                            </svg>
                                                                        </a>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
							</main>
<!-- Other Vendors JS -->
<script src="vendors/datatables/jquery.dataTables.min.js"></script>
<script src="vendors/datatables/dataTables.custom-ui.min.js"></script>

<!-- Page js -->
<script src="js/pages/product-list.js"></script>

<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto">
                                        <div class=" mb-4">
                                            <h3>Danh sách mã giảm giá đã xóa</h3>
                                        </div>
                                        <div class="card adaptable-card">
                                            <div class="card-body">
                                            <table id="product-list-data-table" class="table-default table-hover data-table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>id</th>
                                                    <th>Mã giảm giá</th>
                                                    <th>Nội dung </th>
                                                    <th>Số tiền giảm</th>
                                                    <th>Ngày hết hạn</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php
                                                 extract($data);
                                                 foreach ($data as $cuppon){
                                                     extract($cuppon);
                                                     
                                                    ?>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                                <label class="checkbox-label mb-0">
                                                                    <input class="checkbox order-checkbox" type="checkbox" value="">
                                                                </label>
                                                        </td>
                                                        <td>
                                                             <span class="cursor-pointer select-none font-semibold hover:text-indigo-600"><?=$id_giam_gia?></span>
                                                        </td>
                                                        <td>
                                                            <span><?=$ma_giam_gia?></span>
                                                        </td>
                                                        <td>
                                                                <?=$noi_dung?>
                                                        </td>
                                                        <td>
                                                            <span class="font-semibold"><?php echo number_format($so_tien_giam, 0, ',', '.').'đ' ?></span>  
                                                        </td>
                                                        <td>
                                                            <span class="font-semibold"><?=$ngay_het_han?></span>  
                                                        </td>   
                                                        <td>
                                                                <div class="flex justify-end text-lg">
                                                                    <span class="cursor-pointer p-2 hover:text-indigo-600" data-bs-toggle="tooltip" data-bs-title="Sửa">
                                                                       <a href="admin.php?act=ctdonhang&ma_don_hang=<?php echo $ma_don_hang?>">
                                                                       <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="0.9em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                       
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                                                       
                                                                        </svg>
                                                                       </a>
                                                                    </span>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                                </tbody>
                                                    </thead>
                                                </table>
                                            
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
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa không?');
    }
</script>
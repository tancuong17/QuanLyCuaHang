<div class="tab">
   <div id="price-manager-header">
      <p style="font-size: 1.2rem;">Thống kê</p>
      <div class="form-header">
         <div class="search-container">
            <div class="form-search">
               <input type="date" id="startDateSearch"/>
               <img src="https://www.svgrepo.com/show/376370/arrow-right-line.svg" alt="image" />
               <input type="date" id="endDateSearch"/>
               <img onclick="Statistical()" src="https://cdn-icons-png.flaticon.com/512/3917/3917132.png" alt="image" />
            </div>
            <form action="http://localhost/quanlycuahang/api/exportExcel" method="post">
               <input name="startDateStatistical" id="startDateStatistical" style="display: none;"/>
               <input name="endDateStatistical" id="endDateStatistical" style="display: none;"/>
               <button type="submit" style="background-color: green; border: 1px solid green;">Xuất báo cáo</button>
            </form>
         </div>
      </div>
   </div>
   <div id="table-statistical" style="position: relative;">
      <table id="statistical" style="width: 100%;">
         <tr>
            <th>STT</th>
            <th>MÃ</th>
            <th>SẢN PHẨM</th>
            <th>SỐ LƯỢNG</th>
            <th>ĐƠN GIÁ</th>
            <th>DOANH THU</th>
         </tr>
         <div id="note" style="width: 100%; height: 80vh; position: absolute; gap: 0.5rem; display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <img style="width: 10rem; height: 10rem; object-fit: cover;border-radius: 50%;"
               src="https://thumbs.gfycat.com/HarshQuerulousFinnishspitz-size_restricted.gif" />
            <p>Hãy chọn ngày để thống kê!</p>
         </div>
         <div id="load" style="width: 100%; height: 80vh; position: absolute; gap: 0.5rem; display: none; justify-content: center; align-items: center; flex-direction: column;">
            <img style="width: 10rem; height: 10rem; object-fit: cover;border-radius: 50%;"
               src="https://media.tenor.com/YUF4morhOVcAAAAM/peach-cat-boba-tea.gif" />
            <p>Đang tải chờ xíu!</p>
         </div>
         <div id="no-result" style="width: 100%; height: 80vh; position: absolute; gap: 0.5rem; display: none; justify-content: center; align-items: center; flex-direction: column;">
            <img style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 50%;"
               src="https://media.tenor.com/6-uKeByY478AAAAM/imissyoulods-brrt-brrt.gif" />
            <p>Không có thống kê nào!</p>
         </div>
      </table>
   </div>
</div>
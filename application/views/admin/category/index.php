<div class="content-wrapper">
  <div class="container">
    <h1 class="pt-3">Danh sách danh mục</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
      Thêm danh mục
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Name <span class="text-danger font-weight-bold">(*)</span></label>
                <input type="text" name="name" class="form-control " id="exampleInputEmail1" aria-describedby="name"
                  placeholder="Ten">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="addCategories()">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th scope="col">
            <input name="checkall" type="checkbox" id="checkAll">
          </th>
          <th scope="col">#</th>
          <th scope="col">Tên danh mục</th>
          <th scope="col">Tổng số bài viết</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody id="projects-table-body">

      </tbody>
    </table>

  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
showProject();

function showProject() {
  axios.get('category/show')
    .then((response) => {
      let kq = response;
      $("#projects-table-body").html("");
      for (let i = 0; i < kq.data.length; i++) {
        let result = `
			<tr id="row-${kq.data[i].id}">
          <td>
            <input type="checkbox" name="id[]" value="${kq.data[i].id}">
          </td>
          <th scope="row">${kq.data[i].id}</th>
          <td>${kq.data[i].name}</td>
          <td>${kq.data[i].totally}</td>
          <td>
            <a href="#" class="btn btn-danger xoa" onclick="dlt(${kq.data[i].id})"> <i class="fa fa-times"></i></a>
            <a href="#" class="btn btn-warning xoa"  > <i class="fa fa-pencil" ></i></a>
          </td>
        </tr>
			`;
        $("#projects-table-body").append(result);
      }
    });


}

function dlt(id) {
  swal({
      title: "Bạn có chắc muốn xóa",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var deleteUri = 'category/delete/' + "/" + id;
        axios.delete(deleteUri)
          .then(response => {
            if (response.statusText == "OK") {
              var x = document.querySelector(".swal-button--confirm");
              x.addEventListener('click', function() {
                var removeElement = document.querySelector(('#row-' + id));
                removeElement.remove();
              })
            }
          })
        swal("Xóa dữ liệu thành công", {
          icon: "success",
        });
      } else {
        swal("Xóa dữ liệu thất bại");
      }
    })
}

function addCategories() {

  const name = document.querySelector('[name="name"]').value;
  const options = {
    headers: {
      'Content-Type': 'application/json;charset=UTF-8',
      "Access-Control-Allow-Origin": "*",
    }
  };
  axios.post("<?php  echo base_url(); ?>admin/category/store", {
      name
    }, options)
    .then(data => {
      if (data.statusText === "Created") {
        swal("Thêm dữ liệu thành công", "", "success");
      }
    })

}
</script>
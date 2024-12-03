<div class="dashboard" id="nilaiLayout">
    <h2>Data Nilai</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Karyawan</th>
                <th scope="col">Disiplin</th>
                <th scope="col">Kerapian</th>
                <th scope="col">Kreativitas</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($model["nilai"] as $nilai) : ?>
                <?php
                $karyawan = $model["findKaryawan"];
                $karyawanId = array_column($karyawan, "id");
                $idx = array_search($nilai["id_karyawan"], $karyawanId);
                ?>
                <tr>
                    <th scope="row"><?= $i + $model["mainPage"] ?></th>
                    <td><?= $karyawan[$idx]["nama"] ?></td>
                    <td><?= $nilai["disiplin"] ?></td>
                    <td><?= $nilai["kerapian"] ?></td>
                    <td><?= $nilai["kreativitas"] ?></td>
                    <td>
                        <a href="" class="table-link deletePenilaian"  value="<?= $nilai["id"] ?>"><i class="bi bi-trash"></i></a>
                        <a href="" class="table-link updatePenilaian" data-bs-toggle="modal" data-bs-target="#updateNilai" value="<?= $nilai["id"] ?>"><i class="bi bi-tools"></i></a>
                    </td>
                </tr>

            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
    <nav aria-label="...">
    <ul class="pagination justify-content-center">
      <li class="page-item <?= $model["activePage"] == 1 ? "disabled" : "" ?>">
        <a class="page-link" href="?page=<?= $model["activePage"] - 1 ?>">Previous</a>
      </li>
      <?php for ($i = 1; $i <= $model["totalPage"]; $i++) : ?>
        <li class="page-item <?= $model["activePage"] == $i || !isset($_GET["page"]) && $i == 1 ? "active" : "" ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?= $model["activePage"] == $model["totalPage"] ? "disabled" : "" ?>">
        <a class="page-link" href="?page=<?= $model["activePage"] + 1 ?>">Next</a>
      </li>
    </ul>
  </nav>

</div>


<!-- Modal -->
<div class="modal fade" id="updateNilai" tabindex="-1" aria-labelledby="nilai" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nilai">Update Nilai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?=$BASEURL?>/updateNilai" id="nilaiUpdate" class="bg-body" method="POST">
          <div class="mb-3 form-floating">
            <input type="number" class="form-control" name="disiplin" min="0" max="100" id="disiplin" placeholder="Masukkan Nilai Disiplin Karyawan..." required>
            <label for="displin">Disiplin</label>
          </div>
          <div class="mb-3 form-floating">
            <input type="number" min="0" max="100" class="form-control" id="kerapian" name="kerapian" placeholder="Masukkan Nilai Kerapian Karyawan..." required>
            <label for="kerapian">Kerapian</label>
          </div>
          <div class="mb-3 form-floating">
          <input type="number" min="0" max="100" class="form-control" id="kreativitas" name="kreativitas" placeholder="Masukkan Nilai Kreativitas Karyawan..." required>
            <label for="kreativitas">Kreativitas</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Nilai</button>
      </div>
      </form>
    </div>
  </div>
</div>
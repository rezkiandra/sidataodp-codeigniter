<?php
class M_odp extends ci_model
{
  public function get_teknisi_id($user_id)
  {
    $this->db->where('id_user', $user_id);
    $query = $this->db->get('teknisi');

    if ($query->num_rows() > 0) {
      return $query->row()->id_teknisi;
    } else {
      return false;
    }
  }

  public function get_data()
  {
    $this->db->order_by('id_odp', 'DESC');
    return $query = $this->db->get('odp');
  }

  public function get_data2()
  {
    $this->db->select('*');
    $this->db->from('odps');
    $this->db->join('odp', 'odps.id_odp = odp.id_odp', 'left');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->order_by('id_odps', 'DESC');
    return $query = $this->db->get();
  }

  public function get_pt2()
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->order_by('id_odp', 'DESC');
    $this->db->where('status =', 'Sedang Dikerjakan');
    return $query = $this->db->get();
  }

  public function get_odp()
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->order_by('id_odp', 'DESC');
    $this->db->where('status =', 'Selesai');
    return $query = $this->db->get();
  }

  public function get_odps()
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->where('odp.status =', 'Sedang Dipelihara');
    $this->db->order_by('id_odp', 'DESC');
    return $query = $this->db->get();
  }

  public function get_odp_count()
  {
    $this->db->where('status =', 'Sedang Dikerjakan');
    return $this->db->count_all_results('odp');
  }

  public function get_odps_count()
  {
    $this->db->where('status =', 'Sedang Dipelihara');
    return $this->db->count_all_results('odp');
  }

  public function get_odps_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('odps');
    $this->db->join('odp', 'odps.id_odp = odp.id_odp', 'left');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->where('id_odps', $id);
    $this->db->order_by('id_odps', 'DESC');
    return $query = $this->db->get();
  }

  public function data_join()
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi');
    $this->db->where('status !=', 'Selesai');

    $this->db->order_by('id_odp', 'DESC');
    return $query = $this->db->get();
  }

  public function get_pt2_by_id_teknisi($id_teknisi)
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi');
    $this->db->where('teknisi.id_teknisi', $id_teknisi);
    $this->db->where('odp.status =', 'Sedang Dikerjakan');
    $this->db->order_by('odp.id_odp', 'DESC');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return [];
    }
  }
  public function get_odp_by_id_teknisi($id_teknisi)
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi');
    $this->db->where('teknisi.id_teknisi', $id_teknisi);
    $this->db->where('odp.status =', 'Selesai');
    $this->db->order_by('odp.id_odp', 'DESC');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return [];
    }
  }

  public function get_odps_by_id_teknisi($id_teknisi)
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi');
    $this->db->where('teknisi.id_teknisi', $id_teknisi);
    $this->db->where('odp.status =', 'Sedang Dipelihara');
    $this->db->order_by('odp.id_odp', 'DESC');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return [];
    }
  }

  public function get_odp_count_by_id_teknisi($id_teknisi)
  {
    $this->db->where('id_teknisi', $id_teknisi);
    $this->db->from('odp');
    $this->db->where('odp.status =', 'Sedang Dikerjakan');
    return $this->db->count_all_results();
  }

  public function get_odps_count_by_id_teknisi($id_teknisi)
  {
    $this->db->where('id_teknisi', $id_teknisi);
    $this->db->from('odp');
    $this->db->where('odp.status =', 'Sedang Dipelihara');
    return $this->db->count_all_results();
  }

  public function jmlperbulanPT2Pegawai($tglAwal, $tglAkhir, $id_teknisi)
  {
    $this->db->select('*');
    $this->db->from('odp');

    $this->db->where('odp.id_teknisi', $id_teknisi);
    $this->db->where('odp.tgl_pendataan >=', $tglAwal);
    $this->db->where('odp.tgl_pendataan <=', $tglAkhir);
    $this->db->where('odp.status =', 'Sedang Dikerjakan');
    return $query = $this->db->get();
  }

  public function jmlperbulanODPSPegawai($tglAwal, $tglAkhir, $id_teknisi)
  {
    $this->db->select('*');
    $this->db->from('odp');

    $this->db->where('odp.id_teknisi', $id_teknisi);
    $this->db->where('odp.tgl_pendataan >=', $tglAwal);
    $this->db->where('odp.tgl_pendataan <=', $tglAkhir);
    $this->db->where('odp.status =', 'Sedang Dipelihara');
    return $query = $this->db->get();
  }

  public function jmlperbulanPT2($tglAwal, $tglAkhir)
  {
    $this->db->select('*');
    $this->db->from('odp');

    $this->db->where('odp.tgl_pendataan >=', $tglAwal);
    $this->db->where('odp.tgl_pendataan <=', $tglAkhir);
    $this->db->where('odp.status =', 'Sedang Dikerjakan');
    return $query = $this->db->get();
  }

  public function jmlperbulanODPS($tglAwal, $tglAkhir)
  {
    $this->db->select('*');
    $this->db->from('odp');

    $this->db->where('odp.tgl_pendataan >=', $tglAwal);
    $this->db->where('odp.tgl_pendataan <=', $tglAkhir);
    $this->db->where('odp.status =', 'Sedang Dipelihara');
    return $query = $this->db->get();
  }

  public function totalStok()
  {
    $data = $this->db
      ->select_sum('stok')
      ->from('barang')
      ->get();
    $stok = $data->row();
    return $stok->stok;
  }

  public function get_odp_by_id($id)
  {
    $this->db->select("*");
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi', 'left');
    $this->db->where('id_odp', $id);

    return $this->db->get('odp');
  }

  public function detail_join($where)
  {
    $this->db->select('*');
    $this->db->from('odp');
    $this->db->where('id_odp', $where);
    $this->db->join('teknisi', 'odp.id_teknisi = teknisi.id_teknisi');

    $this->db->order_by('id_odp', 'DESC');
    return $query = $this->db->get();
  }

  public function ambilFoto($where)
  {
    $this->db->order_by('id_odp', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get_where('odp', $where);

    $data = $query->row();
    $foto = $data->foto;

    return $foto;
  }

  public function ambil_stok($where)
  {
    $this->db->order_by('id_barang', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get_where('barang', $where);
    $data = $query->row();
    $stok = $data->stok;
    return $stok;
  }

  public function ambilId($table, $where)
  {
    return $this->db->get_where($table, $where);
  }

  public function hapus_data($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
    if ($this->db->affected_rows() == 1) {
      return TRUE;
    }
    return false;
  }

  public function detail_data($where, $table)
  {
    return $this->db->get_where($table, $where);
  }

  public function tambah_data($data, $table)
  {
    $this->db->insert($table, $data);
  }

  public function ubah_data($where, $data, $table)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }


  public function buat_kode()
  {
    $this->db->select('RIGHT(barang.id_barang,4) as kode', FALSE);
    $this->db->order_by('id_barang', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('barang');      //cek dulu apakah ada sudah ada kode di tabel.
    if ($query->num_rows() <> 0) {
      //jika kode ternyata sudah ada.
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    } else {
      //jika kode belum ada
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
    $kodejadi = "BRG-" . $kodemax;
    return $kodejadi;
  }
}

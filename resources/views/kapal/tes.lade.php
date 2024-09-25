 <!-- MODAL EDIT DATA -->
 <div class="ui modal edit">
     <div class="header">Ubah Data Bendera</div>
     <div class="content">
         <form class="ui form" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="two fields">
                 <div class="field">
                     <label>Kode Bendera
                     </label>
                     <input type="hidden" id="edit-id" name="flag_idx">
                     <input type="text" id="edit-kode-bendera" name="kode_bendera">
                 </div>
                 <div class="field">
                     <label>Asal Negara
                     </label>
                     <input type="text" id="edit-asal-negara" name="asal_negara">
                 </div>
             </div>
     </div>
     <div class="actions">

         <button class="ui positive right labeled icon button buttonEdit" type="submit">
             Simpan
             <i class="checkmark icon"></i>
         </button>
         </form>
     </div>
 </div>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav" style="padding-top: 10px!important">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>"
                                aria-expanded="false"><span class="material-symbols-rounded">home</span><span class="hide-menu pt-1 pl-2">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="<?= base_url(); ?>/news"
                                aria-expanded="false"><span class="material-symbols-rounded">newspaper</span><span
                                    class="hide-menu pt-1 pl-2">Pengumuman
                                </span></a>
                        </li>
                        <?php if (in_groups('admin')): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="material-symbols-rounded">database</span>
                                <span class="hide-menu pt-1 pl-2">Master Data</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/data/school" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Biodata Sekolah</span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/data/classgroup" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Data Kelas</span></a></li>
                                <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Data Guru</span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/data/subject" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Data Mata Pelajaran</span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url(); ?>/data/student"><span class="hide-menu pt-1 pl-2"> Data Siswa</span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url(); ?>/data/relation"><span class="hide-menu pt-1 pl-2"> Relasi</span></a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url(); ?>/data/tasktype"><span class="hide-menu pt-1 pl-2"> Jenis Tugas</span></a></li>
                            </ul>
                        </li>
                        <?php endif  ?>

                        <?php if (in_groups(['admin','teacher'])): ?>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><span class="material-symbols-rounded">local_library</span><span class="hide-menu pt-1 pl-2">Pembelajaran</span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <!-- <li class="sidebar-item"><a href="<?= base_url(); ?>/learn/meet" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Pertemuan</span></a></li> -->
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/data/modul" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Materi Belajar</span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/learn/task" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Tugas Belajar</span></a></li>
                                <!-- <li class="sidebar-item"><a href="<?= base_url(); ?>/learn/interactive" class="sidebar-link"></i><span class="hide-menu pt-1 pl-2">Kelas Interaktif</span></a> -->
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/learn/classes" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> KelasKu</span></a></li>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link hass-arrow" href="<?= base_url(); ?>/learn/journal" aria-expanded="false">
                                <span class="material-symbols-rounded">checklist_rtl</span>
                                <span class="hide-menu pt-1 pl-2">Jurnal</span>
                            </a> -->

                            <!-- <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/journal" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Input</span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/journal/rekap" class="sidebar-link"><span class="hide-menu pt-1 pl-2"> Rekap</span></a></li>
                                </li>
                            </ul> -->
                        <!-- </li> -->

                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link hass-arrow" href="<?= base_url(); ?>/skp" aria-expanded="false">
                                <span class="material-symbols-rounded">checklist_rtl</span>
                                <span class="hide-menu pt-1 pl-2">Penilaian Kinerja</span>
                            </a>
                        </li> -->
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><span class="material-symbols-rounded">design_services</span><span class="hide-menu pt-1 pl-2">CBT</span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/ujian" class="sidebar-link"><span class="hide-menu pt-1 pl-2">Hasil Ujian</span></a></li>
                                <?php if (has_permission('proktor')): ?>
                                    <li class="sidebar-item"><a href="<?= base_url(); ?>/ujian/cbt" class="sidebar-link"><span class="hide-menu pt-1 pl-2">Jadwal Ujian</span></a></li>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </li>

                        <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/data/absensi" aria-expanded="false"><span class="material-symbols-rounded">pin_drop</span><span class="hide-menu pt-1 pl-2">Rekap Absensi</span></a>
                        </li> -->
                        
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/questbank" aria-expanded="false"><span class="material-symbols-rounded">library_books</span><span class="hide-menu pt-1 pl-2">Bank Soal</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/attitude" aria-expanded="false"><span class="material-symbols-rounded">history_edu</span><span class="hide-menu pt-1 pl-2">Penilaian Sikap</span></a>
                        </li>
                        <?php endif ?>

                        <?php if (in_groups('student')): ?>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url() ?>/student/classes"
                                aria-expanded="false"><span class="material-symbols-rounded">local_library</span><span
                                    class="hide-menu pt-1 pl-2">Kelas Ku</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="<?= base_url(); ?>/student/tasks"
                                aria-expanded="false"><span class="material-symbols-rounded">design_services</span><span
                                    class="hide-menu pt-1 pl-2">Tugas
                                </span></a>
                        </li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/student/absen"
                                aria-expanded="false"><span class="material-symbols-rounded">pin_drop</span><span
                                    class="hide-menu pt-1 pl-2">Absensi</span></a>
                        </li> -->
                        <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="#"
                                aria-expanded="false"><i class="fa fa-trophy"></i><span
                                    class="hide-menu pt-1 pl-2">Hasil Belajar</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="#"
                                aria-expanded="false"><i class="fa fa-users"></i><span
                                    class="hide-menu pt-1 pl-2">Kelas Interaktif</span></a>
                        </li> -->
                        <?php endif ?>
                        <?php if (in_groups('admin')): ?>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><span class="material-symbols-rounded">settings</span></i><span class="hide-menu pt-1 pl-2">Setting</span></a>
                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/setting" class="sidebar-link"><span class="hide-menu pt-1 pl-2">Aplikasi</span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/setting/users" class="sidebar-link"><span class="hide-menu pt-1 pl-2">Users</span></a></li>
                                </li>
                                <li class="sidebar-item"><a href="<?= base_url(); ?>/setting/groups" class="sidebar-link"><span class="hide-menu pt-1 pl-2">Users Group</span></a></li>
                                </li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/profile" aria-expanded="false">
                                <span class="material-symbols-rounded">person</span>
                                <span class="hide-menu pt-1 pl-2">Profil</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url(); ?>/logout" aria-expanded="false"><span class="material-symbols-rounded">rocket_launch</span>
                                <span class="hide-menu pt-1 pl-2">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
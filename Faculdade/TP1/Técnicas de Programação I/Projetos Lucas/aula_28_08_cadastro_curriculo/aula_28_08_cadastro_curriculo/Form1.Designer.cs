namespace aula_28_08_cadastro_curriculo
{
    partial class Form1
    {
        /// <summary>
        /// Variável de designer necessária.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Limpar os recursos que estão sendo usados.
        /// </summary>
        /// <param name="disposing">verdade se for necessário descartar os recursos gerenciados; caso contrário, falso.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region código gerado pelo Windows Form Designer

        /// <summary>
        /// Método necessário para suporte do Designer - não modifique
        /// o conteúdo deste método com o editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            this.tcCadastroCurriculo = new System.Windows.Forms.TabControl();
            this.tpPessoal = new System.Windows.Forms.TabPage();
            this.btSalvarPessoal = new System.Windows.Forms.Button();
            this.btLimparPessoal = new System.Windows.Forms.Button();
            this.tbEmail = new System.Windows.Forms.TextBox();
            this.tbEndereco = new System.Windows.Forms.TextBox();
            this.tbNome = new System.Windows.Forms.TextBox();
            this.mtbCel = new System.Windows.Forms.MaskedTextBox();
            this.mtbTel = new System.Windows.Forms.MaskedTextBox();
            this.lbEndereco = new System.Windows.Forms.Label();
            this.mtbDtNasc = new System.Windows.Forms.MaskedTextBox();
            this.mtbCPF = new System.Windows.Forms.MaskedTextBox();
            this.label1lbCel = new System.Windows.Forms.Label();
            this.lbTel = new System.Windows.Forms.Label();
            this.lbEmail = new System.Windows.Forms.Label();
            this.lbDataNasc = new System.Windows.Forms.Label();
            this.lbCPF = new System.Windows.Forms.Label();
            this.lbNome = new System.Windows.Forms.Label();
            this.tpFormacao = new System.Windows.Forms.TabPage();
            this.btSalvarFormacao = new System.Windows.Forms.Button();
            this.btLimparFormacao = new System.Windows.Forms.Button();
            this.dgFormacao = new System.Windows.Forms.DataGridView();
            this.clInsituicao = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clNivel = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clAno = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clNome = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.tbNomeCurso = new System.Windows.Forms.TextBox();
            this.tbAno = new System.Windows.Forms.TextBox();
            this.tbInstituicao = new System.Windows.Forms.TextBox();
            this.lbNomeCurso = new System.Windows.Forms.Label();
            this.lbAno = new System.Windows.Forms.Label();
            this.lbInstituicao = new System.Windows.Forms.Label();
            this.lbNivel = new System.Windows.Forms.Label();
            this.cbNivel = new System.Windows.Forms.ComboBox();
            this.tpProfisional = new System.Windows.Forms.TabPage();
            this.dgProfisional = new System.Windows.Forms.DataGridView();
            this.clFuncao = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clEmpresa = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clInicio = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.clFim = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.tbEmpresa = new System.Windows.Forms.TextBox();
            this.tbFuncao = new System.Windows.Forms.TextBox();
            this.mtbFim = new System.Windows.Forms.MaskedTextBox();
            this.mtbInicio = new System.Windows.Forms.MaskedTextBox();
            this.lbFim = new System.Windows.Forms.Label();
            this.lbInicio = new System.Windows.Forms.Label();
            this.lbEmpresa = new System.Windows.Forms.Label();
            this.lbFuncao = new System.Windows.Forms.Label();
            this.btSalvarProfissional = new System.Windows.Forms.Button();
            this.btLimparProfissional = new System.Windows.Forms.Button();
            this.btFechar = new System.Windows.Forms.Button();
            this.tcCadastroCurriculo.SuspendLayout();
            this.tpPessoal.SuspendLayout();
            this.tpFormacao.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgFormacao)).BeginInit();
            this.tpProfisional.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgProfisional)).BeginInit();
            this.SuspendLayout();
            // 
            // tcCadastroCurriculo
            // 
            this.tcCadastroCurriculo.Controls.Add(this.tpPessoal);
            this.tcCadastroCurriculo.Controls.Add(this.tpFormacao);
            this.tcCadastroCurriculo.Controls.Add(this.tpProfisional);
            this.tcCadastroCurriculo.Location = new System.Drawing.Point(12, 12);
            this.tcCadastroCurriculo.Name = "tcCadastroCurriculo";
            this.tcCadastroCurriculo.SelectedIndex = 0;
            this.tcCadastroCurriculo.Size = new System.Drawing.Size(593, 308);
            this.tcCadastroCurriculo.TabIndex = 0;
            // 
            // tpPessoal
            // 
            this.tpPessoal.Controls.Add(this.btSalvarPessoal);
            this.tpPessoal.Controls.Add(this.btLimparPessoal);
            this.tpPessoal.Controls.Add(this.tbEmail);
            this.tpPessoal.Controls.Add(this.tbEndereco);
            this.tpPessoal.Controls.Add(this.tbNome);
            this.tpPessoal.Controls.Add(this.mtbCel);
            this.tpPessoal.Controls.Add(this.mtbTel);
            this.tpPessoal.Controls.Add(this.lbEndereco);
            this.tpPessoal.Controls.Add(this.mtbDtNasc);
            this.tpPessoal.Controls.Add(this.mtbCPF);
            this.tpPessoal.Controls.Add(this.label1lbCel);
            this.tpPessoal.Controls.Add(this.lbTel);
            this.tpPessoal.Controls.Add(this.lbEmail);
            this.tpPessoal.Controls.Add(this.lbDataNasc);
            this.tpPessoal.Controls.Add(this.lbCPF);
            this.tpPessoal.Controls.Add(this.lbNome);
            this.tpPessoal.Location = new System.Drawing.Point(4, 22);
            this.tpPessoal.Name = "tpPessoal";
            this.tpPessoal.Padding = new System.Windows.Forms.Padding(3);
            this.tpPessoal.Size = new System.Drawing.Size(585, 282);
            this.tpPessoal.TabIndex = 0;
            this.tpPessoal.Text = "Pessoal";
            this.tpPessoal.UseVisualStyleBackColor = true;
            this.tpPessoal.Click += new System.EventHandler(this.tpPessoal_Click);
            // 
            // btSalvarPessoal
            // 
            this.btSalvarPessoal.BackColor = System.Drawing.Color.Transparent;
            this.btSalvarPessoal.Location = new System.Drawing.Point(504, 219);
            this.btSalvarPessoal.Name = "btSalvarPessoal";
            this.btSalvarPessoal.Size = new System.Drawing.Size(75, 23);
            this.btSalvarPessoal.TabIndex = 22;
            this.btSalvarPessoal.Text = "Salvar";
            this.btSalvarPessoal.UseVisualStyleBackColor = false;
            this.btSalvarPessoal.Click += new System.EventHandler(this.btSalvarPessoal_Click);
            // 
            // btLimparPessoal
            // 
            this.btLimparPessoal.Location = new System.Drawing.Point(504, 248);
            this.btLimparPessoal.Name = "btLimparPessoal";
            this.btLimparPessoal.Size = new System.Drawing.Size(75, 23);
            this.btLimparPessoal.TabIndex = 21;
            this.btLimparPessoal.Text = "Limpar";
            this.btLimparPessoal.UseVisualStyleBackColor = true;
            // 
            // tbEmail
            // 
            this.tbEmail.Location = new System.Drawing.Point(119, 158);
            this.tbEmail.Name = "tbEmail";
            this.tbEmail.Size = new System.Drawing.Size(387, 20);
            this.tbEmail.TabIndex = 13;
            // 
            // tbEndereco
            // 
            this.tbEndereco.Location = new System.Drawing.Point(119, 84);
            this.tbEndereco.Name = "tbEndereco";
            this.tbEndereco.Size = new System.Drawing.Size(387, 20);
            this.tbEndereco.TabIndex = 12;
            // 
            // tbNome
            // 
            this.tbNome.Location = new System.Drawing.Point(119, 16);
            this.tbNome.Name = "tbNome";
            this.tbNome.Size = new System.Drawing.Size(387, 20);
            this.tbNome.TabIndex = 11;
            // 
            // mtbCel
            // 
            this.mtbCel.Location = new System.Drawing.Point(419, 118);
            this.mtbCel.Mask = "(000) 0000-0000";
            this.mtbCel.Name = "mtbCel";
            this.mtbCel.Size = new System.Drawing.Size(87, 20);
            this.mtbCel.TabIndex = 10;
            // 
            // mtbTel
            // 
            this.mtbTel.Location = new System.Drawing.Point(119, 118);
            this.mtbTel.Mask = "(000) 0000-0000";
            this.mtbTel.Name = "mtbTel";
            this.mtbTel.Size = new System.Drawing.Size(82, 20);
            this.mtbTel.TabIndex = 9;
            // 
            // lbEndereco
            // 
            this.lbEndereco.AutoSize = true;
            this.lbEndereco.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEndereco.Location = new System.Drawing.Point(24, 84);
            this.lbEndereco.Name = "lbEndereco";
            this.lbEndereco.Size = new System.Drawing.Size(79, 16);
            this.lbEndereco.TabIndex = 8;
            this.lbEndereco.Text = "Endereço:";
            // 
            // mtbDtNasc
            // 
            this.mtbDtNasc.Location = new System.Drawing.Point(435, 50);
            this.mtbDtNasc.Mask = "00/00/0000";
            this.mtbDtNasc.Name = "mtbDtNasc";
            this.mtbDtNasc.Size = new System.Drawing.Size(71, 20);
            this.mtbDtNasc.TabIndex = 7;
            this.mtbDtNasc.ValidatingType = typeof(System.DateTime);
            this.mtbDtNasc.MaskInputRejected += new System.Windows.Forms.MaskInputRejectedEventHandler(this.mtbDtNasc_MaskInputRejected);
            // 
            // mtbCPF
            // 
            this.mtbCPF.Location = new System.Drawing.Point(119, 50);
            this.mtbCPF.Mask = "000.000.000-00";
            this.mtbCPF.Name = "mtbCPF";
            this.mtbCPF.Size = new System.Drawing.Size(82, 20);
            this.mtbCPF.TabIndex = 6;
            // 
            // label1lbCel
            // 
            this.label1lbCel.AutoSize = true;
            this.label1lbCel.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1lbCel.Location = new System.Drawing.Point(374, 119);
            this.label1lbCel.Name = "label1lbCel";
            this.label1lbCel.Size = new System.Drawing.Size(39, 16);
            this.label1lbCel.TabIndex = 5;
            this.label1lbCel.Text = "Cel.:";
            this.label1lbCel.Click += new System.EventHandler(this.label1lbCel_Click);
            // 
            // lbTel
            // 
            this.lbTel.AutoSize = true;
            this.lbTel.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTel.Location = new System.Drawing.Point(62, 119);
            this.lbTel.Name = "lbTel";
            this.lbTel.Size = new System.Drawing.Size(39, 16);
            this.lbTel.TabIndex = 4;
            this.lbTel.Text = "Tel.:";
            // 
            // lbEmail
            // 
            this.lbEmail.AutoSize = true;
            this.lbEmail.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEmail.Location = new System.Drawing.Point(50, 159);
            this.lbEmail.Name = "lbEmail";
            this.lbEmail.Size = new System.Drawing.Size(51, 16);
            this.lbEmail.TabIndex = 3;
            this.lbEmail.Text = "Email:";
            // 
            // lbDataNasc
            // 
            this.lbDataNasc.AutoSize = true;
            this.lbDataNasc.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbDataNasc.Location = new System.Drawing.Point(340, 51);
            this.lbDataNasc.Name = "lbDataNasc";
            this.lbDataNasc.Size = new System.Drawing.Size(89, 16);
            this.lbDataNasc.TabIndex = 2;
            this.lbDataNasc.Text = "Data Nasc.:";
            this.lbDataNasc.Click += new System.EventHandler(this.lbDataNasc_Click);
            // 
            // lbCPF
            // 
            this.lbCPF.AutoSize = true;
            this.lbCPF.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCPF.Location = new System.Drawing.Point(62, 54);
            this.lbCPF.Name = "lbCPF";
            this.lbCPF.Size = new System.Drawing.Size(41, 16);
            this.lbCPF.TabIndex = 1;
            this.lbCPF.Text = "CPF:";
            // 
            // lbNome
            // 
            this.lbNome.AutoSize = true;
            this.lbNome.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbNome.Location = new System.Drawing.Point(50, 18);
            this.lbNome.Name = "lbNome";
            this.lbNome.Size = new System.Drawing.Size(53, 16);
            this.lbNome.TabIndex = 0;
            this.lbNome.Text = "Nome:";
            this.lbNome.Click += new System.EventHandler(this.label1_Click);
            // 
            // tpFormacao
            // 
            this.tpFormacao.Controls.Add(this.btSalvarFormacao);
            this.tpFormacao.Controls.Add(this.btLimparFormacao);
            this.tpFormacao.Controls.Add(this.dgFormacao);
            this.tpFormacao.Controls.Add(this.tbNomeCurso);
            this.tpFormacao.Controls.Add(this.tbAno);
            this.tpFormacao.Controls.Add(this.tbInstituicao);
            this.tpFormacao.Controls.Add(this.lbNomeCurso);
            this.tpFormacao.Controls.Add(this.lbAno);
            this.tpFormacao.Controls.Add(this.lbInstituicao);
            this.tpFormacao.Controls.Add(this.lbNivel);
            this.tpFormacao.Controls.Add(this.cbNivel);
            this.tpFormacao.Location = new System.Drawing.Point(4, 22);
            this.tpFormacao.Name = "tpFormacao";
            this.tpFormacao.Padding = new System.Windows.Forms.Padding(3);
            this.tpFormacao.Size = new System.Drawing.Size(585, 282);
            this.tpFormacao.TabIndex = 1;
            this.tpFormacao.Text = "Formação";
            this.tpFormacao.UseVisualStyleBackColor = true;
            this.tpFormacao.Click += new System.EventHandler(this.tpFormacao_Click);
            // 
            // btSalvarFormacao
            // 
            this.btSalvarFormacao.BackColor = System.Drawing.Color.Transparent;
            this.btSalvarFormacao.Location = new System.Drawing.Point(504, 223);
            this.btSalvarFormacao.Name = "btSalvarFormacao";
            this.btSalvarFormacao.Size = new System.Drawing.Size(75, 23);
            this.btSalvarFormacao.TabIndex = 24;
            this.btSalvarFormacao.Text = "Salvar";
            this.btSalvarFormacao.UseVisualStyleBackColor = false;
            this.btSalvarFormacao.Click += new System.EventHandler(this.button1_Click);
            // 
            // btLimparFormacao
            // 
            this.btLimparFormacao.Location = new System.Drawing.Point(504, 252);
            this.btLimparFormacao.Name = "btLimparFormacao";
            this.btLimparFormacao.Size = new System.Drawing.Size(75, 23);
            this.btLimparFormacao.TabIndex = 23;
            this.btLimparFormacao.Text = "Limpar";
            this.btLimparFormacao.UseVisualStyleBackColor = true;
            // 
            // dgFormacao
            // 
            this.dgFormacao.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgFormacao.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.clInsituicao,
            this.clNivel,
            this.clAno,
            this.clNome});
            this.dgFormacao.Location = new System.Drawing.Point(107, 103);
            this.dgFormacao.Name = "dgFormacao";
            this.dgFormacao.Size = new System.Drawing.Size(391, 172);
            this.dgFormacao.TabIndex = 8;
            // 
            // clInsituicao
            // 
            this.clInsituicao.HeaderText = "Instituição";
            this.clInsituicao.Name = "clInsituicao";
            this.clInsituicao.Width = 130;
            // 
            // clNivel
            // 
            this.clNivel.HeaderText = "Nivel";
            this.clNivel.Name = "clNivel";
            this.clNivel.Width = 78;
            // 
            // clAno
            // 
            this.clAno.HeaderText = "Ano";
            this.clAno.Name = "clAno";
            this.clAno.Width = 35;
            // 
            // clNome
            // 
            this.clNome.HeaderText = "Nome";
            this.clNome.Name = "clNome";
            this.clNome.Width = 105;
            // 
            // tbNomeCurso
            // 
            this.tbNomeCurso.Location = new System.Drawing.Point(107, 77);
            this.tbNomeCurso.Name = "tbNomeCurso";
            this.tbNomeCurso.Size = new System.Drawing.Size(391, 20);
            this.tbNomeCurso.TabIndex = 7;
            // 
            // tbAno
            // 
            this.tbAno.Location = new System.Drawing.Point(428, 46);
            this.tbAno.Name = "tbAno";
            this.tbAno.Size = new System.Drawing.Size(70, 20);
            this.tbAno.TabIndex = 6;
            // 
            // tbInstituicao
            // 
            this.tbInstituicao.Location = new System.Drawing.Point(107, 18);
            this.tbInstituicao.Name = "tbInstituicao";
            this.tbInstituicao.Size = new System.Drawing.Size(391, 20);
            this.tbInstituicao.TabIndex = 5;
            // 
            // lbNomeCurso
            // 
            this.lbNomeCurso.AutoSize = true;
            this.lbNomeCurso.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbNomeCurso.Location = new System.Drawing.Point(48, 77);
            this.lbNomeCurso.Name = "lbNomeCurso";
            this.lbNomeCurso.Size = new System.Drawing.Size(53, 16);
            this.lbNomeCurso.TabIndex = 4;
            this.lbNomeCurso.Text = "Nome:";
            // 
            // lbAno
            // 
            this.lbAno.AutoSize = true;
            this.lbAno.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbAno.Location = new System.Drawing.Point(383, 50);
            this.lbAno.Name = "lbAno";
            this.lbAno.Size = new System.Drawing.Size(39, 16);
            this.lbAno.TabIndex = 3;
            this.lbAno.Text = "Ano:";
            // 
            // lbInstituicao
            // 
            this.lbInstituicao.AutoSize = true;
            this.lbInstituicao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbInstituicao.Location = new System.Drawing.Point(19, 19);
            this.lbInstituicao.Name = "lbInstituicao";
            this.lbInstituicao.Size = new System.Drawing.Size(82, 16);
            this.lbInstituicao.TabIndex = 2;
            this.lbInstituicao.Text = "Instituição:";
            // 
            // lbNivel
            // 
            this.lbNivel.AutoSize = true;
            this.lbNivel.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbNivel.Location = new System.Drawing.Point(53, 50);
            this.lbNivel.Name = "lbNivel";
            this.lbNivel.Size = new System.Drawing.Size(48, 16);
            this.lbNivel.TabIndex = 1;
            this.lbNivel.Text = "Nivel:";
            this.lbNivel.Click += new System.EventHandler(this.label1_Click_1);
            // 
            // cbNivel
            // 
            this.cbNivel.FormattingEnabled = true;
            this.cbNivel.Items.AddRange(new object[] {
            "Ensino Médio Completo",
            "Ensino Médio Incompleto",
            "Ensino Técnico Completo",
            "Ensino Técnico Incompleto",
            "Ensino Superior Completo",
            "Ensino Superior Incompleto"});
            this.cbNivel.Location = new System.Drawing.Point(107, 45);
            this.cbNivel.Name = "cbNivel";
            this.cbNivel.Size = new System.Drawing.Size(251, 21);
            this.cbNivel.TabIndex = 0;
            this.cbNivel.SelectedIndexChanged += new System.EventHandler(this.cbNivel_SelectedIndexChanged);
            // 
            // tpProfisional
            // 
            this.tpProfisional.Controls.Add(this.dgProfisional);
            this.tpProfisional.Controls.Add(this.tbEmpresa);
            this.tpProfisional.Controls.Add(this.tbFuncao);
            this.tpProfisional.Controls.Add(this.mtbFim);
            this.tpProfisional.Controls.Add(this.mtbInicio);
            this.tpProfisional.Controls.Add(this.lbFim);
            this.tpProfisional.Controls.Add(this.lbInicio);
            this.tpProfisional.Controls.Add(this.lbEmpresa);
            this.tpProfisional.Controls.Add(this.lbFuncao);
            this.tpProfisional.Controls.Add(this.btSalvarProfissional);
            this.tpProfisional.Controls.Add(this.btLimparProfissional);
            this.tpProfisional.Location = new System.Drawing.Point(4, 22);
            this.tpProfisional.Name = "tpProfisional";
            this.tpProfisional.Padding = new System.Windows.Forms.Padding(3);
            this.tpProfisional.Size = new System.Drawing.Size(585, 282);
            this.tpProfisional.TabIndex = 2;
            this.tpProfisional.Text = "Profisional";
            this.tpProfisional.UseVisualStyleBackColor = true;
            // 
            // dgProfisional
            // 
            this.dgProfisional.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgProfisional.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.clFuncao,
            this.clEmpresa,
            this.clInicio,
            this.clFim});
            this.dgProfisional.Location = new System.Drawing.Point(104, 107);
            this.dgProfisional.Name = "dgProfisional";
            this.dgProfisional.Size = new System.Drawing.Size(394, 167);
            this.dgProfisional.TabIndex = 33;
            // 
            // clFuncao
            // 
            this.clFuncao.HeaderText = "Função";
            this.clFuncao.Name = "clFuncao";
            // 
            // clEmpresa
            // 
            this.clEmpresa.HeaderText = "Empresa";
            this.clEmpresa.Name = "clEmpresa";
            this.clEmpresa.Width = 150;
            // 
            // clInicio
            // 
            this.clInicio.HeaderText = "Inicio";
            this.clInicio.Name = "clInicio";
            this.clInicio.Width = 50;
            // 
            // clFim
            // 
            this.clFim.HeaderText = "Fim";
            this.clFim.Name = "clFim";
            this.clFim.Width = 50;
            // 
            // tbEmpresa
            // 
            this.tbEmpresa.Location = new System.Drawing.Point(107, 39);
            this.tbEmpresa.Name = "tbEmpresa";
            this.tbEmpresa.Size = new System.Drawing.Size(391, 20);
            this.tbEmpresa.TabIndex = 32;
            // 
            // tbFuncao
            // 
            this.tbFuncao.Location = new System.Drawing.Point(107, 13);
            this.tbFuncao.Name = "tbFuncao";
            this.tbFuncao.Size = new System.Drawing.Size(391, 20);
            this.tbFuncao.TabIndex = 31;
            // 
            // mtbFim
            // 
            this.mtbFim.Location = new System.Drawing.Point(427, 71);
            this.mtbFim.Mask = "00/00/0000";
            this.mtbFim.Name = "mtbFim";
            this.mtbFim.Size = new System.Drawing.Size(71, 20);
            this.mtbFim.TabIndex = 30;
            this.mtbFim.ValidatingType = typeof(System.DateTime);
            // 
            // mtbInicio
            // 
            this.mtbInicio.Location = new System.Drawing.Point(107, 70);
            this.mtbInicio.Mask = "00/00/0000";
            this.mtbInicio.Name = "mtbInicio";
            this.mtbInicio.Size = new System.Drawing.Size(71, 20);
            this.mtbInicio.TabIndex = 29;
            this.mtbInicio.ValidatingType = typeof(System.DateTime);
            // 
            // lbFim
            // 
            this.lbFim.AutoSize = true;
            this.lbFim.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbFim.Location = new System.Drawing.Point(384, 75);
            this.lbFim.Name = "lbFim";
            this.lbFim.Size = new System.Drawing.Size(37, 16);
            this.lbFim.TabIndex = 28;
            this.lbFim.Text = "Fim:";
            // 
            // lbInicio
            // 
            this.lbInicio.AutoSize = true;
            this.lbInicio.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbInicio.Location = new System.Drawing.Point(52, 75);
            this.lbInicio.Name = "lbInicio";
            this.lbInicio.Size = new System.Drawing.Size(49, 16);
            this.lbInicio.TabIndex = 27;
            this.lbInicio.Text = "Inicio:";
            // 
            // lbEmpresa
            // 
            this.lbEmpresa.AutoSize = true;
            this.lbEmpresa.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEmpresa.Location = new System.Drawing.Point(27, 44);
            this.lbEmpresa.Name = "lbEmpresa";
            this.lbEmpresa.Size = new System.Drawing.Size(74, 16);
            this.lbEmpresa.TabIndex = 26;
            this.lbEmpresa.Text = "Empresa:";
            // 
            // lbFuncao
            // 
            this.lbFuncao.AutoSize = true;
            this.lbFuncao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbFuncao.Location = new System.Drawing.Point(38, 17);
            this.lbFuncao.Name = "lbFuncao";
            this.lbFuncao.Size = new System.Drawing.Size(63, 16);
            this.lbFuncao.TabIndex = 25;
            this.lbFuncao.Text = "Função:";
            // 
            // btSalvarProfissional
            // 
            this.btSalvarProfissional.BackColor = System.Drawing.Color.Transparent;
            this.btSalvarProfissional.Location = new System.Drawing.Point(504, 222);
            this.btSalvarProfissional.Name = "btSalvarProfissional";
            this.btSalvarProfissional.Size = new System.Drawing.Size(75, 23);
            this.btSalvarProfissional.TabIndex = 24;
            this.btSalvarProfissional.Text = "Salvar";
            this.btSalvarProfissional.UseVisualStyleBackColor = false;
            this.btSalvarProfissional.Click += new System.EventHandler(this.button3_Click);
            // 
            // btLimparProfissional
            // 
            this.btLimparProfissional.Location = new System.Drawing.Point(504, 251);
            this.btLimparProfissional.Name = "btLimparProfissional";
            this.btLimparProfissional.Size = new System.Drawing.Size(75, 23);
            this.btLimparProfissional.TabIndex = 23;
            this.btLimparProfissional.Text = "Limpar";
            this.btLimparProfissional.UseVisualStyleBackColor = true;
            // 
            // btFechar
            // 
            this.btFechar.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btFechar.Location = new System.Drawing.Point(520, 326);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 20;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = true;
            this.btFechar.Click += new System.EventHandler(this.btFechar_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(617, 361);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.tcCadastroCurriculo);
            this.Name = "Form1";
            this.Text = "Cadastro Curriculo";
            this.tcCadastroCurriculo.ResumeLayout(false);
            this.tpPessoal.ResumeLayout(false);
            this.tpPessoal.PerformLayout();
            this.tpFormacao.ResumeLayout(false);
            this.tpFormacao.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgFormacao)).EndInit();
            this.tpProfisional.ResumeLayout(false);
            this.tpProfisional.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgProfisional)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.TabControl tcCadastroCurriculo;
        private System.Windows.Forms.TabPage tpPessoal;
        private System.Windows.Forms.Label lbNome;
        private System.Windows.Forms.TabPage tpFormacao;
        private System.Windows.Forms.TabPage tpProfisional;
        private System.Windows.Forms.TextBox tbEmail;
        private System.Windows.Forms.TextBox tbEndereco;
        private System.Windows.Forms.TextBox tbNome;
        private System.Windows.Forms.MaskedTextBox mtbCel;
        private System.Windows.Forms.MaskedTextBox mtbTel;
        private System.Windows.Forms.Label lbEndereco;
        private System.Windows.Forms.MaskedTextBox mtbDtNasc;
        private System.Windows.Forms.MaskedTextBox mtbCPF;
        private System.Windows.Forms.Label label1lbCel;
        private System.Windows.Forms.Label lbTel;
        private System.Windows.Forms.Label lbEmail;
        private System.Windows.Forms.Label lbDataNasc;
        private System.Windows.Forms.Label lbCPF;
        private System.Windows.Forms.Label lbNivel;
        private System.Windows.Forms.ComboBox cbNivel;
        private System.Windows.Forms.DataGridView dgFormacao;
        private System.Windows.Forms.TextBox tbNomeCurso;
        private System.Windows.Forms.TextBox tbAno;
        private System.Windows.Forms.TextBox tbInstituicao;
        private System.Windows.Forms.Label lbNomeCurso;
        private System.Windows.Forms.Label lbAno;
        private System.Windows.Forms.Label lbInstituicao;
        private System.Windows.Forms.Button btSalvarPessoal;
        private System.Windows.Forms.Button btLimparPessoal;
        private System.Windows.Forms.Button btFechar;
        private System.Windows.Forms.Button btSalvarFormacao;
        private System.Windows.Forms.Button btLimparFormacao;
        private System.Windows.Forms.DataGridViewTextBoxColumn clInsituicao;
        private System.Windows.Forms.DataGridViewTextBoxColumn clNivel;
        private System.Windows.Forms.DataGridViewTextBoxColumn clAno;
        private System.Windows.Forms.DataGridViewTextBoxColumn clNome;
        private System.Windows.Forms.Button btSalvarProfissional;
        private System.Windows.Forms.Button btLimparProfissional;
        private System.Windows.Forms.DataGridView dgProfisional;
        private System.Windows.Forms.DataGridViewTextBoxColumn clFuncao;
        private System.Windows.Forms.DataGridViewTextBoxColumn clEmpresa;
        private System.Windows.Forms.DataGridViewTextBoxColumn clInicio;
        private System.Windows.Forms.DataGridViewTextBoxColumn clFim;
        private System.Windows.Forms.TextBox tbEmpresa;
        private System.Windows.Forms.TextBox tbFuncao;
        private System.Windows.Forms.MaskedTextBox mtbFim;
        private System.Windows.Forms.MaskedTextBox mtbInicio;
        private System.Windows.Forms.Label lbFim;
        private System.Windows.Forms.Label lbInicio;
        private System.Windows.Forms.Label lbEmpresa;
        private System.Windows.Forms.Label lbFuncao;
    }
}


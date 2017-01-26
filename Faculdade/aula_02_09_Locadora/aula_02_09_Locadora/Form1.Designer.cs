namespace aula_02_09_Locadora
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
            this.tcFilme = new System.Windows.Forms.TabControl();
            this.tabPage1 = new System.Windows.Forms.TabPage();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btAlterar = new System.Windows.Forms.Button();
            this.btExcluir = new System.Windows.Forms.Button();
            this.btBuscar = new System.Windows.Forms.Button();
            this.btSalvar = new System.Windows.Forms.Button();
            this.cbGenero = new System.Windows.Forms.ComboBox();
            this.tbSinopse = new System.Windows.Forms.TextBox();
            this.tbAtores = new System.Windows.Forms.TextBox();
            this.tbDirecao = new System.Windows.Forms.TextBox();
            this.tbTitulo = new System.Windows.Forms.TextBox();
            this.tbCodigo = new System.Windows.Forms.TextBox();
            this.lbSinopse = new System.Windows.Forms.Label();
            this.lbAtores = new System.Windows.Forms.Label();
            this.lbDirecao = new System.Windows.Forms.Label();
            this.lbTitulo = new System.Windows.Forms.Label();
            this.lbGenero = new System.Windows.Forms.Label();
            this.lbCodigo = new System.Windows.Forms.Label();
            this.tabPage2 = new System.Windows.Forms.TabPage();
            this.btLimparCliente = new System.Windows.Forms.Button();
            this.mtbCelular = new System.Windows.Forms.MaskedTextBox();
            this.mtbTel = new System.Windows.Forms.MaskedTextBox();
            this.mtbCPF = new System.Windows.Forms.MaskedTextBox();
            this.comboBox2 = new System.Windows.Forms.ComboBox();
            this.comboBox1 = new System.Windows.Forms.ComboBox();
            this.tbNome = new System.Windows.Forms.TextBox();
            this.tbEmail = new System.Windows.Forms.TextBox();
            this.tbEndereco = new System.Windows.Forms.TextBox();
            this.lbSituacao = new System.Windows.Forms.Label();
            this.lbEmail = new System.Windows.Forms.Label();
            this.lbEndereco = new System.Windows.Forms.Label();
            this.lbCelular = new System.Windows.Forms.Label();
            this.lbTelefone = new System.Windows.Forms.Label();
            this.lbNome = new System.Windows.Forms.Label();
            this.lbSexo = new System.Windows.Forms.Label();
            this.lbCPF = new System.Windows.Forms.Label();
            this.btAlterarCliente = new System.Windows.Forms.Button();
            this.btExcluirCliente = new System.Windows.Forms.Button();
            this.btBuscarCliente = new System.Windows.Forms.Button();
            this.btSalvarCliente = new System.Windows.Forms.Button();
            this.tabPage3 = new System.Windows.Forms.TabPage();
            this.btLimparLocacao = new System.Windows.Forms.Button();
            this.dtpDtEfetiva = new System.Windows.Forms.DateTimePicker();
            this.dtpDtPrevista = new System.Windows.Forms.DateTimePicker();
            this.cbFilme = new System.Windows.Forms.ComboBox();
            this.cbCliente = new System.Windows.Forms.ComboBox();
            this.btAlterarLocacao = new System.Windows.Forms.Button();
            this.btExcluirLocacao = new System.Windows.Forms.Button();
            this.btBuscarLocacao = new System.Windows.Forms.Button();
            this.btSalvarLocacao = new System.Windows.Forms.Button();
            this.lbDtEfetiva = new System.Windows.Forms.Label();
            this.lbDtPrevista = new System.Windows.Forms.Label();
            this.lbFilme = new System.Windows.Forms.Label();
            this.lbCliente = new System.Windows.Forms.Label();
            this.btFechar = new System.Windows.Forms.Button();
            this.tcFilme.SuspendLayout();
            this.tabPage1.SuspendLayout();
            this.tabPage2.SuspendLayout();
            this.tabPage3.SuspendLayout();
            this.SuspendLayout();
            // 
            // tcFilme
            // 
            this.tcFilme.Controls.Add(this.tabPage1);
            this.tcFilme.Controls.Add(this.tabPage2);
            this.tcFilme.Controls.Add(this.tabPage3);
            this.tcFilme.Location = new System.Drawing.Point(12, 12);
            this.tcFilme.Name = "tcFilme";
            this.tcFilme.SelectedIndex = 0;
            this.tcFilme.Size = new System.Drawing.Size(585, 252);
            this.tcFilme.TabIndex = 0;
            // 
            // tabPage1
            // 
            this.tabPage1.Controls.Add(this.btLimpar);
            this.tabPage1.Controls.Add(this.btAlterar);
            this.tabPage1.Controls.Add(this.btExcluir);
            this.tabPage1.Controls.Add(this.btBuscar);
            this.tabPage1.Controls.Add(this.btSalvar);
            this.tabPage1.Controls.Add(this.cbGenero);
            this.tabPage1.Controls.Add(this.tbSinopse);
            this.tabPage1.Controls.Add(this.tbAtores);
            this.tabPage1.Controls.Add(this.tbDirecao);
            this.tabPage1.Controls.Add(this.tbTitulo);
            this.tabPage1.Controls.Add(this.tbCodigo);
            this.tabPage1.Controls.Add(this.lbSinopse);
            this.tabPage1.Controls.Add(this.lbAtores);
            this.tabPage1.Controls.Add(this.lbDirecao);
            this.tabPage1.Controls.Add(this.lbTitulo);
            this.tabPage1.Controls.Add(this.lbGenero);
            this.tabPage1.Controls.Add(this.lbCodigo);
            this.tabPage1.Location = new System.Drawing.Point(4, 22);
            this.tabPage1.Name = "tabPage1";
            this.tabPage1.Padding = new System.Windows.Forms.Padding(3);
            this.tabPage1.Size = new System.Drawing.Size(577, 226);
            this.tabPage1.TabIndex = 0;
            this.tabPage1.Text = "Filme";
            this.tabPage1.UseVisualStyleBackColor = true;
            // 
            // btLimpar
            // 
            this.btLimpar.BackColor = System.Drawing.Color.Transparent;
            this.btLimpar.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btLimpar.Location = new System.Drawing.Point(253, 197);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 51;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = false;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btAlterar
            // 
            this.btAlterar.BackColor = System.Drawing.Color.Transparent;
            this.btAlterar.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btAlterar.Location = new System.Drawing.Point(496, 197);
            this.btAlterar.Name = "btAlterar";
            this.btAlterar.Size = new System.Drawing.Size(75, 23);
            this.btAlterar.TabIndex = 26;
            this.btAlterar.Text = "Alterar";
            this.btAlterar.UseVisualStyleBackColor = false;
            // 
            // btExcluir
            // 
            this.btExcluir.BackColor = System.Drawing.Color.Transparent;
            this.btExcluir.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btExcluir.Location = new System.Drawing.Point(415, 197);
            this.btExcluir.Name = "btExcluir";
            this.btExcluir.Size = new System.Drawing.Size(75, 23);
            this.btExcluir.TabIndex = 25;
            this.btExcluir.Text = "Excluir";
            this.btExcluir.UseVisualStyleBackColor = false;
            this.btExcluir.Click += new System.EventHandler(this.btExcluir_Click);
            // 
            // btBuscar
            // 
            this.btBuscar.BackColor = System.Drawing.Color.Transparent;
            this.btBuscar.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btBuscar.Location = new System.Drawing.Point(334, 197);
            this.btBuscar.Name = "btBuscar";
            this.btBuscar.Size = new System.Drawing.Size(75, 23);
            this.btBuscar.TabIndex = 24;
            this.btBuscar.Text = "Buscar";
            this.btBuscar.UseVisualStyleBackColor = false;
            this.btBuscar.Click += new System.EventHandler(this.btBuscar_Click);
            // 
            // btSalvar
            // 
            this.btSalvar.BackColor = System.Drawing.Color.Transparent;
            this.btSalvar.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btSalvar.Location = new System.Drawing.Point(172, 197);
            this.btSalvar.Name = "btSalvar";
            this.btSalvar.Size = new System.Drawing.Size(75, 23);
            this.btSalvar.TabIndex = 23;
            this.btSalvar.Text = "Salvar";
            this.btSalvar.UseVisualStyleBackColor = false;
            this.btSalvar.Click += new System.EventHandler(this.btSalvar_Click);
            // 
            // cbGenero
            // 
            this.cbGenero.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.cbGenero.FormattingEnabled = true;
            this.cbGenero.Location = new System.Drawing.Point(361, 20);
            this.cbGenero.Name = "cbGenero";
            this.cbGenero.Size = new System.Drawing.Size(210, 24);
            this.cbGenero.TabIndex = 12;
            // 
            // tbSinopse
            // 
            this.tbSinopse.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbSinopse.Location = new System.Drawing.Point(79, 128);
            this.tbSinopse.Multiline = true;
            this.tbSinopse.Name = "tbSinopse";
            this.tbSinopse.Size = new System.Drawing.Size(492, 66);
            this.tbSinopse.TabIndex = 11;
            // 
            // tbAtores
            // 
            this.tbAtores.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbAtores.Location = new System.Drawing.Point(79, 102);
            this.tbAtores.Name = "tbAtores";
            this.tbAtores.Size = new System.Drawing.Size(492, 22);
            this.tbAtores.TabIndex = 10;
            // 
            // tbDirecao
            // 
            this.tbDirecao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbDirecao.Location = new System.Drawing.Point(79, 74);
            this.tbDirecao.Name = "tbDirecao";
            this.tbDirecao.Size = new System.Drawing.Size(492, 22);
            this.tbDirecao.TabIndex = 9;
            // 
            // tbTitulo
            // 
            this.tbTitulo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbTitulo.Location = new System.Drawing.Point(79, 46);
            this.tbTitulo.Name = "tbTitulo";
            this.tbTitulo.Size = new System.Drawing.Size(492, 22);
            this.tbTitulo.TabIndex = 8;
            // 
            // tbCodigo
            // 
            this.tbCodigo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbCodigo.Location = new System.Drawing.Point(79, 19);
            this.tbCodigo.Name = "tbCodigo";
            this.tbCodigo.Size = new System.Drawing.Size(211, 22);
            this.tbCodigo.TabIndex = 6;
            // 
            // lbSinopse
            // 
            this.lbSinopse.AutoSize = true;
            this.lbSinopse.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbSinopse.Location = new System.Drawing.Point(15, 125);
            this.lbSinopse.Name = "lbSinopse";
            this.lbSinopse.Size = new System.Drawing.Size(65, 16);
            this.lbSinopse.TabIndex = 5;
            this.lbSinopse.Text = "Sinopse";
            // 
            // lbAtores
            // 
            this.lbAtores.AutoSize = true;
            this.lbAtores.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbAtores.Location = new System.Drawing.Point(15, 100);
            this.lbAtores.Name = "lbAtores";
            this.lbAtores.Size = new System.Drawing.Size(53, 16);
            this.lbAtores.TabIndex = 4;
            this.lbAtores.Text = "Atores";
            // 
            // lbDirecao
            // 
            this.lbDirecao.AutoSize = true;
            this.lbDirecao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbDirecao.Location = new System.Drawing.Point(15, 74);
            this.lbDirecao.Name = "lbDirecao";
            this.lbDirecao.Size = new System.Drawing.Size(63, 16);
            this.lbDirecao.TabIndex = 3;
            this.lbDirecao.Text = "Direção";
            // 
            // lbTitulo
            // 
            this.lbTitulo.AutoSize = true;
            this.lbTitulo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTitulo.Location = new System.Drawing.Point(15, 46);
            this.lbTitulo.Name = "lbTitulo";
            this.lbTitulo.Size = new System.Drawing.Size(47, 16);
            this.lbTitulo.TabIndex = 2;
            this.lbTitulo.Text = "Título";
            // 
            // lbGenero
            // 
            this.lbGenero.AutoSize = true;
            this.lbGenero.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbGenero.Location = new System.Drawing.Point(296, 20);
            this.lbGenero.Name = "lbGenero";
            this.lbGenero.Size = new System.Drawing.Size(59, 16);
            this.lbGenero.TabIndex = 1;
            this.lbGenero.Text = "Gênero";
            // 
            // lbCodigo
            // 
            this.lbCodigo.AutoSize = true;
            this.lbCodigo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCodigo.Location = new System.Drawing.Point(15, 20);
            this.lbCodigo.Name = "lbCodigo";
            this.lbCodigo.Size = new System.Drawing.Size(58, 16);
            this.lbCodigo.TabIndex = 0;
            this.lbCodigo.Text = "Código";
            // 
            // tabPage2
            // 
            this.tabPage2.Controls.Add(this.btLimparCliente);
            this.tabPage2.Controls.Add(this.mtbCelular);
            this.tabPage2.Controls.Add(this.mtbTel);
            this.tabPage2.Controls.Add(this.mtbCPF);
            this.tabPage2.Controls.Add(this.comboBox2);
            this.tabPage2.Controls.Add(this.comboBox1);
            this.tabPage2.Controls.Add(this.tbNome);
            this.tabPage2.Controls.Add(this.tbEmail);
            this.tabPage2.Controls.Add(this.tbEndereco);
            this.tabPage2.Controls.Add(this.lbSituacao);
            this.tabPage2.Controls.Add(this.lbEmail);
            this.tabPage2.Controls.Add(this.lbEndereco);
            this.tabPage2.Controls.Add(this.lbCelular);
            this.tabPage2.Controls.Add(this.lbTelefone);
            this.tabPage2.Controls.Add(this.lbNome);
            this.tabPage2.Controls.Add(this.lbSexo);
            this.tabPage2.Controls.Add(this.lbCPF);
            this.tabPage2.Controls.Add(this.btAlterarCliente);
            this.tabPage2.Controls.Add(this.btExcluirCliente);
            this.tabPage2.Controls.Add(this.btBuscarCliente);
            this.tabPage2.Controls.Add(this.btSalvarCliente);
            this.tabPage2.Location = new System.Drawing.Point(4, 22);
            this.tabPage2.Name = "tabPage2";
            this.tabPage2.Padding = new System.Windows.Forms.Padding(3);
            this.tabPage2.Size = new System.Drawing.Size(577, 226);
            this.tabPage2.TabIndex = 1;
            this.tabPage2.Text = "Cliente";
            this.tabPage2.UseVisualStyleBackColor = true;
            // 
            // btLimparCliente
            // 
            this.btLimparCliente.BackColor = System.Drawing.Color.Transparent;
            this.btLimparCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btLimparCliente.Location = new System.Drawing.Point(253, 197);
            this.btLimparCliente.Name = "btLimparCliente";
            this.btLimparCliente.Size = new System.Drawing.Size(75, 23);
            this.btLimparCliente.TabIndex = 51;
            this.btLimparCliente.Text = "Limpar";
            this.btLimparCliente.UseVisualStyleBackColor = false;
            // 
            // mtbCelular
            // 
            this.mtbCelular.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.mtbCelular.Location = new System.Drawing.Point(353, 62);
            this.mtbCelular.Mask = "(000) 0000-0000";
            this.mtbCelular.Name = "mtbCelular";
            this.mtbCelular.Size = new System.Drawing.Size(179, 22);
            this.mtbCelular.TabIndex = 49;
            // 
            // mtbTel
            // 
            this.mtbTel.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.mtbTel.Location = new System.Drawing.Point(91, 67);
            this.mtbTel.Mask = "(000) 0000-0000";
            this.mtbTel.Name = "mtbTel";
            this.mtbTel.Size = new System.Drawing.Size(179, 22);
            this.mtbTel.TabIndex = 48;
            // 
            // mtbCPF
            // 
            this.mtbCPF.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.mtbCPF.Location = new System.Drawing.Point(91, 12);
            this.mtbCPF.Mask = "000.000.000-00";
            this.mtbCPF.Name = "mtbCPF";
            this.mtbCPF.Size = new System.Drawing.Size(179, 22);
            this.mtbCPF.TabIndex = 47;
            // 
            // comboBox2
            // 
            this.comboBox2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.comboBox2.FormattingEnabled = true;
            this.comboBox2.Location = new System.Drawing.Point(91, 143);
            this.comboBox2.Name = "comboBox2";
            this.comboBox2.Size = new System.Drawing.Size(179, 24);
            this.comboBox2.TabIndex = 46;
            // 
            // comboBox1
            // 
            this.comboBox1.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.comboBox1.FormattingEnabled = true;
            this.comboBox1.Location = new System.Drawing.Point(353, 12);
            this.comboBox1.Name = "comboBox1";
            this.comboBox1.Size = new System.Drawing.Size(179, 24);
            this.comboBox1.TabIndex = 45;
            // 
            // tbNome
            // 
            this.tbNome.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbNome.Location = new System.Drawing.Point(91, 39);
            this.tbNome.Name = "tbNome";
            this.tbNome.Size = new System.Drawing.Size(441, 22);
            this.tbNome.TabIndex = 44;
            // 
            // tbEmail
            // 
            this.tbEmail.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbEmail.Location = new System.Drawing.Point(91, 117);
            this.tbEmail.Name = "tbEmail";
            this.tbEmail.Size = new System.Drawing.Size(441, 22);
            this.tbEmail.TabIndex = 43;
            // 
            // tbEndereco
            // 
            this.tbEndereco.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbEndereco.Location = new System.Drawing.Point(91, 91);
            this.tbEndereco.Name = "tbEndereco";
            this.tbEndereco.Size = new System.Drawing.Size(441, 22);
            this.tbEndereco.TabIndex = 39;
            // 
            // lbSituacao
            // 
            this.lbSituacao.AutoSize = true;
            this.lbSituacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbSituacao.Location = new System.Drawing.Point(13, 148);
            this.lbSituacao.Name = "lbSituacao";
            this.lbSituacao.Size = new System.Drawing.Size(69, 16);
            this.lbSituacao.TabIndex = 38;
            this.lbSituacao.Text = "Situação";
            // 
            // lbEmail
            // 
            this.lbEmail.AutoSize = true;
            this.lbEmail.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEmail.Location = new System.Drawing.Point(13, 121);
            this.lbEmail.Name = "lbEmail";
            this.lbEmail.Size = new System.Drawing.Size(47, 16);
            this.lbEmail.TabIndex = 37;
            this.lbEmail.Text = "Email";
            // 
            // lbEndereco
            // 
            this.lbEndereco.AutoSize = true;
            this.lbEndereco.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEndereco.Location = new System.Drawing.Point(13, 95);
            this.lbEndereco.Name = "lbEndereco";
            this.lbEndereco.Size = new System.Drawing.Size(75, 16);
            this.lbEndereco.TabIndex = 36;
            this.lbEndereco.Text = "Endereço";
            this.lbEndereco.Click += new System.EventHandler(this.lbEndereco_Click);
            // 
            // lbCelular
            // 
            this.lbCelular.AutoSize = true;
            this.lbCelular.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCelular.Location = new System.Drawing.Point(286, 68);
            this.lbCelular.Name = "lbCelular";
            this.lbCelular.Size = new System.Drawing.Size(57, 16);
            this.lbCelular.TabIndex = 35;
            this.lbCelular.Text = "Celular";
            // 
            // lbTelefone
            // 
            this.lbTelefone.AutoSize = true;
            this.lbTelefone.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTelefone.Location = new System.Drawing.Point(13, 68);
            this.lbTelefone.Name = "lbTelefone";
            this.lbTelefone.Size = new System.Drawing.Size(70, 16);
            this.lbTelefone.TabIndex = 34;
            this.lbTelefone.Text = "Telefone";
            // 
            // lbNome
            // 
            this.lbNome.AutoSize = true;
            this.lbNome.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbNome.Location = new System.Drawing.Point(13, 43);
            this.lbNome.Name = "lbNome";
            this.lbNome.Size = new System.Drawing.Size(49, 16);
            this.lbNome.TabIndex = 33;
            this.lbNome.Text = "Nome";
            // 
            // lbSexo
            // 
            this.lbSexo.AutoSize = true;
            this.lbSexo.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbSexo.Location = new System.Drawing.Point(286, 17);
            this.lbSexo.Name = "lbSexo";
            this.lbSexo.Size = new System.Drawing.Size(43, 16);
            this.lbSexo.TabIndex = 32;
            this.lbSexo.Text = "Sexo";
            // 
            // lbCPF
            // 
            this.lbCPF.AutoSize = true;
            this.lbCPF.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCPF.Location = new System.Drawing.Point(13, 17);
            this.lbCPF.Name = "lbCPF";
            this.lbCPF.Size = new System.Drawing.Size(37, 16);
            this.lbCPF.TabIndex = 31;
            this.lbCPF.Text = "CPF";
            // 
            // btAlterarCliente
            // 
            this.btAlterarCliente.BackColor = System.Drawing.Color.Transparent;
            this.btAlterarCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btAlterarCliente.Location = new System.Drawing.Point(496, 197);
            this.btAlterarCliente.Name = "btAlterarCliente";
            this.btAlterarCliente.Size = new System.Drawing.Size(75, 23);
            this.btAlterarCliente.TabIndex = 30;
            this.btAlterarCliente.Text = "Alterar";
            this.btAlterarCliente.UseVisualStyleBackColor = false;
            // 
            // btExcluirCliente
            // 
            this.btExcluirCliente.BackColor = System.Drawing.Color.Transparent;
            this.btExcluirCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btExcluirCliente.Location = new System.Drawing.Point(415, 197);
            this.btExcluirCliente.Name = "btExcluirCliente";
            this.btExcluirCliente.Size = new System.Drawing.Size(75, 23);
            this.btExcluirCliente.TabIndex = 29;
            this.btExcluirCliente.Text = "Excluir";
            this.btExcluirCliente.UseVisualStyleBackColor = false;
            // 
            // btBuscarCliente
            // 
            this.btBuscarCliente.BackColor = System.Drawing.Color.Transparent;
            this.btBuscarCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btBuscarCliente.Location = new System.Drawing.Point(334, 197);
            this.btBuscarCliente.Name = "btBuscarCliente";
            this.btBuscarCliente.Size = new System.Drawing.Size(75, 23);
            this.btBuscarCliente.TabIndex = 28;
            this.btBuscarCliente.Text = "Buscar";
            this.btBuscarCliente.UseVisualStyleBackColor = false;
            // 
            // btSalvarCliente
            // 
            this.btSalvarCliente.BackColor = System.Drawing.Color.Transparent;
            this.btSalvarCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btSalvarCliente.Location = new System.Drawing.Point(172, 197);
            this.btSalvarCliente.Name = "btSalvarCliente";
            this.btSalvarCliente.Size = new System.Drawing.Size(75, 23);
            this.btSalvarCliente.TabIndex = 27;
            this.btSalvarCliente.Text = "Salvar";
            this.btSalvarCliente.UseVisualStyleBackColor = false;
            this.btSalvarCliente.Click += new System.EventHandler(this.btSalvarCliente_Click);
            // 
            // tabPage3
            // 
            this.tabPage3.Controls.Add(this.btLimparLocacao);
            this.tabPage3.Controls.Add(this.dtpDtEfetiva);
            this.tabPage3.Controls.Add(this.dtpDtPrevista);
            this.tabPage3.Controls.Add(this.cbFilme);
            this.tabPage3.Controls.Add(this.cbCliente);
            this.tabPage3.Controls.Add(this.btAlterarLocacao);
            this.tabPage3.Controls.Add(this.btExcluirLocacao);
            this.tabPage3.Controls.Add(this.btBuscarLocacao);
            this.tabPage3.Controls.Add(this.btSalvarLocacao);
            this.tabPage3.Controls.Add(this.lbDtEfetiva);
            this.tabPage3.Controls.Add(this.lbDtPrevista);
            this.tabPage3.Controls.Add(this.lbFilme);
            this.tabPage3.Controls.Add(this.lbCliente);
            this.tabPage3.Location = new System.Drawing.Point(4, 22);
            this.tabPage3.Name = "tabPage3";
            this.tabPage3.Padding = new System.Windows.Forms.Padding(3);
            this.tabPage3.Size = new System.Drawing.Size(577, 226);
            this.tabPage3.TabIndex = 2;
            this.tabPage3.Text = "Locação";
            this.tabPage3.UseVisualStyleBackColor = true;
            this.tabPage3.Click += new System.EventHandler(this.tabPage3_Click);
            // 
            // btLimparLocacao
            // 
            this.btLimparLocacao.BackColor = System.Drawing.Color.Transparent;
            this.btLimparLocacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btLimparLocacao.Location = new System.Drawing.Point(253, 197);
            this.btLimparLocacao.Name = "btLimparLocacao";
            this.btLimparLocacao.Size = new System.Drawing.Size(75, 23);
            this.btLimparLocacao.TabIndex = 50;
            this.btLimparLocacao.Text = "Limpar";
            this.btLimparLocacao.UseVisualStyleBackColor = false;
            // 
            // dtpDtEfetiva
            // 
            this.dtpDtEfetiva.Location = new System.Drawing.Point(126, 102);
            this.dtpDtEfetiva.Name = "dtpDtEfetiva";
            this.dtpDtEfetiva.Size = new System.Drawing.Size(443, 20);
            this.dtpDtEfetiva.TabIndex = 49;
            // 
            // dtpDtPrevista
            // 
            this.dtpDtPrevista.Location = new System.Drawing.Point(126, 73);
            this.dtpDtPrevista.Name = "dtpDtPrevista";
            this.dtpDtPrevista.Size = new System.Drawing.Size(443, 20);
            this.dtpDtPrevista.TabIndex = 48;
            // 
            // cbFilme
            // 
            this.cbFilme.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.cbFilme.FormattingEnabled = true;
            this.cbFilme.Location = new System.Drawing.Point(126, 40);
            this.cbFilme.Name = "cbFilme";
            this.cbFilme.Size = new System.Drawing.Size(443, 24);
            this.cbFilme.TabIndex = 47;
            // 
            // cbCliente
            // 
            this.cbCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.cbCliente.FormattingEnabled = true;
            this.cbCliente.Location = new System.Drawing.Point(126, 10);
            this.cbCliente.Name = "cbCliente";
            this.cbCliente.Size = new System.Drawing.Size(443, 24);
            this.cbCliente.TabIndex = 46;
            // 
            // btAlterarLocacao
            // 
            this.btAlterarLocacao.BackColor = System.Drawing.Color.Transparent;
            this.btAlterarLocacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btAlterarLocacao.Location = new System.Drawing.Point(496, 197);
            this.btAlterarLocacao.Name = "btAlterarLocacao";
            this.btAlterarLocacao.Size = new System.Drawing.Size(75, 23);
            this.btAlterarLocacao.TabIndex = 39;
            this.btAlterarLocacao.Text = "Alterar";
            this.btAlterarLocacao.UseVisualStyleBackColor = false;
            // 
            // btExcluirLocacao
            // 
            this.btExcluirLocacao.BackColor = System.Drawing.Color.Transparent;
            this.btExcluirLocacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btExcluirLocacao.Location = new System.Drawing.Point(415, 197);
            this.btExcluirLocacao.Name = "btExcluirLocacao";
            this.btExcluirLocacao.Size = new System.Drawing.Size(75, 23);
            this.btExcluirLocacao.TabIndex = 38;
            this.btExcluirLocacao.Text = "Excluir";
            this.btExcluirLocacao.UseVisualStyleBackColor = false;
            // 
            // btBuscarLocacao
            // 
            this.btBuscarLocacao.BackColor = System.Drawing.Color.Transparent;
            this.btBuscarLocacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btBuscarLocacao.Location = new System.Drawing.Point(334, 197);
            this.btBuscarLocacao.Name = "btBuscarLocacao";
            this.btBuscarLocacao.Size = new System.Drawing.Size(75, 23);
            this.btBuscarLocacao.TabIndex = 37;
            this.btBuscarLocacao.Text = "Buscar";
            this.btBuscarLocacao.UseVisualStyleBackColor = false;
            // 
            // btSalvarLocacao
            // 
            this.btSalvarLocacao.BackColor = System.Drawing.Color.Transparent;
            this.btSalvarLocacao.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btSalvarLocacao.Location = new System.Drawing.Point(172, 197);
            this.btSalvarLocacao.Name = "btSalvarLocacao";
            this.btSalvarLocacao.Size = new System.Drawing.Size(75, 23);
            this.btSalvarLocacao.TabIndex = 36;
            this.btSalvarLocacao.Text = "Salvar";
            this.btSalvarLocacao.UseVisualStyleBackColor = false;
            this.btSalvarLocacao.Click += new System.EventHandler(this.btSalvarLocacao_Click);
            // 
            // lbDtEfetiva
            // 
            this.lbDtEfetiva.AutoSize = true;
            this.lbDtEfetiva.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbDtEfetiva.Location = new System.Drawing.Point(18, 102);
            this.lbDtEfetiva.Name = "lbDtEfetiva";
            this.lbDtEfetiva.Size = new System.Drawing.Size(93, 16);
            this.lbDtEfetiva.TabIndex = 35;
            this.lbDtEfetiva.Text = "Data Efetiva";
            // 
            // lbDtPrevista
            // 
            this.lbDtPrevista.AutoSize = true;
            this.lbDtPrevista.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbDtPrevista.Location = new System.Drawing.Point(18, 77);
            this.lbDtPrevista.Name = "lbDtPrevista";
            this.lbDtPrevista.Size = new System.Drawing.Size(102, 16);
            this.lbDtPrevista.TabIndex = 34;
            this.lbDtPrevista.Text = "Data Prevista";
            // 
            // lbFilme
            // 
            this.lbFilme.AutoSize = true;
            this.lbFilme.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbFilme.Location = new System.Drawing.Point(18, 48);
            this.lbFilme.Name = "lbFilme";
            this.lbFilme.Size = new System.Drawing.Size(46, 16);
            this.lbFilme.TabIndex = 33;
            this.lbFilme.Text = "Filme";
            // 
            // lbCliente
            // 
            this.lbCliente.AutoSize = true;
            this.lbCliente.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCliente.Location = new System.Drawing.Point(18, 18);
            this.lbCliente.Name = "lbCliente";
            this.lbCliente.Size = new System.Drawing.Size(56, 16);
            this.lbCliente.TabIndex = 32;
            this.lbCliente.Text = "Cliente";
            // 
            // btFechar
            // 
            this.btFechar.BackColor = System.Drawing.Color.Transparent;
            this.btFechar.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btFechar.Location = new System.Drawing.Point(512, 271);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 27;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(609, 306);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.tcFilme);
            this.Name = "Form1";
            this.Text = "Locadora";
            this.tcFilme.ResumeLayout(false);
            this.tabPage1.ResumeLayout(false);
            this.tabPage1.PerformLayout();
            this.tabPage2.ResumeLayout(false);
            this.tabPage2.PerformLayout();
            this.tabPage3.ResumeLayout(false);
            this.tabPage3.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.TabControl tcFilme;
        private System.Windows.Forms.TabPage tabPage1;
        private System.Windows.Forms.Button btAlterar;
        private System.Windows.Forms.Button btExcluir;
        private System.Windows.Forms.Button btBuscar;
        private System.Windows.Forms.Button btSalvar;
        private System.Windows.Forms.ComboBox cbGenero;
        private System.Windows.Forms.TextBox tbSinopse;
        private System.Windows.Forms.TextBox tbAtores;
        private System.Windows.Forms.TextBox tbDirecao;
        private System.Windows.Forms.TextBox tbTitulo;
        private System.Windows.Forms.TextBox tbCodigo;
        private System.Windows.Forms.Label lbSinopse;
        private System.Windows.Forms.Label lbAtores;
        private System.Windows.Forms.Label lbDirecao;
        private System.Windows.Forms.Label lbTitulo;
        private System.Windows.Forms.Label lbGenero;
        private System.Windows.Forms.Label lbCodigo;
        private System.Windows.Forms.TabPage tabPage2;
        private System.Windows.Forms.ComboBox comboBox2;
        private System.Windows.Forms.ComboBox comboBox1;
        private System.Windows.Forms.TextBox tbNome;
        private System.Windows.Forms.TextBox tbEmail;
        private System.Windows.Forms.TextBox tbEndereco;
        private System.Windows.Forms.Label lbSituacao;
        private System.Windows.Forms.Label lbEmail;
        private System.Windows.Forms.Label lbEndereco;
        private System.Windows.Forms.Label lbCelular;
        private System.Windows.Forms.Label lbTelefone;
        private System.Windows.Forms.Label lbNome;
        private System.Windows.Forms.Label lbSexo;
        private System.Windows.Forms.Label lbCPF;
        private System.Windows.Forms.Button btAlterarCliente;
        private System.Windows.Forms.Button btExcluirCliente;
        private System.Windows.Forms.Button btBuscarCliente;
        private System.Windows.Forms.Button btSalvarCliente;
        private System.Windows.Forms.TabPage tabPage3;
        private System.Windows.Forms.Button btFechar;
        private System.Windows.Forms.MaskedTextBox mtbCelular;
        private System.Windows.Forms.MaskedTextBox mtbTel;
        private System.Windows.Forms.MaskedTextBox mtbCPF;
        private System.Windows.Forms.Button btAlterarLocacao;
        private System.Windows.Forms.Button btExcluirLocacao;
        private System.Windows.Forms.Button btBuscarLocacao;
        private System.Windows.Forms.Button btSalvarLocacao;
        private System.Windows.Forms.Label lbDtEfetiva;
        private System.Windows.Forms.Label lbDtPrevista;
        private System.Windows.Forms.Label lbFilme;
        private System.Windows.Forms.Label lbCliente;
        private System.Windows.Forms.ComboBox cbFilme;
        private System.Windows.Forms.ComboBox cbCliente;
        private System.Windows.Forms.DateTimePicker dtpDtEfetiva;
        private System.Windows.Forms.DateTimePicker dtpDtPrevista;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btLimparCliente;
        private System.Windows.Forms.Button btLimparLocacao;
    }
}


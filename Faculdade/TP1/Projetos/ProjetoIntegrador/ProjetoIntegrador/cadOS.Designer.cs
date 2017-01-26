namespace ProjetoIntegrador
{
    partial class cadOS
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.label5 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.tbObsOS = new System.Windows.Forms.TextBox();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.dtOS = new System.Windows.Forms.DateTimePicker();
            this.cbClienteOS = new System.Windows.Forms.ComboBox();
            this.tblPessoaBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.bdLojaInfoDataSet = new ProjetoIntegrador.bdLojaInfoDataSet();
            this.cbFuncOS = new System.Windows.Forms.ComboBox();
            this.tblPessoaBindingSource1 = new System.Windows.Forms.BindingSource(this.components);
            this.cbServicoOS = new System.Windows.Forms.ComboBox();
            this.tblTipoServicoBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tbValorOS = new System.Windows.Forms.TextBox();
            this.tblUnidadeBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblPessoaTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblPessoaTableAdapter();
            this.fKtblFuncionariotblPessoa1BindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblFuncionarioTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblFuncionarioTableAdapter();
            this.tblTipoServicoTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblTipoServicoTableAdapter();
            this.tblUnidadeTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.tblPessoaBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblPessoaBindingSource1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblTipoServicoBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblFuncionariotblPessoa1BindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(56, 16);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(37, 18);
            this.label5.TabIndex = 7;
            this.label5.Text = "Data:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(37, 44);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(89, 18);
            this.label1.TabIndex = 8;
            this.label1.Text = "Nome Cliente:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(14, 71);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(114, 18);
            this.label2.TabIndex = 9;
            this.label2.Text = "Nome Funcionario:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(44, 98);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(82, 18);
            this.label3.TabIndex = 10;
            this.label3.Text = "Tipo Serviço:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(90, 128);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(36, 18);
            this.label4.TabIndex = 11;
            this.label4.Text = "Obs.:";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label6.Location = new System.Drawing.Point(75, 269);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(41, 18);
            this.label6.TabIndex = 12;
            this.label6.Text = "Valor:";
            // 
            // tbObsOS
            // 
            this.tbObsOS.Location = new System.Drawing.Point(134, 127);
            this.tbObsOS.Multiline = true;
            this.tbObsOS.Name = "tbObsOS";
            this.tbObsOS.Size = new System.Drawing.Size(447, 135);
            this.tbObsOS.TabIndex = 13;
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(423, 298);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 18;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(504, 298);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 17;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(342, 298);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 16;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            // 
            // dtOS
            // 
            this.dtOS.Location = new System.Drawing.Point(134, 16);
            this.dtOS.Name = "dtOS";
            this.dtOS.Size = new System.Drawing.Size(228, 20);
            this.dtOS.TabIndex = 19;
            // 
            // cbClienteOS
            // 
            this.cbClienteOS.DataSource = this.tblPessoaBindingSource;
            this.cbClienteOS.DisplayMember = "nome";
            this.cbClienteOS.FormattingEnabled = true;
            this.cbClienteOS.Location = new System.Drawing.Point(134, 43);
            this.cbClienteOS.Name = "cbClienteOS";
            this.cbClienteOS.Size = new System.Drawing.Size(445, 21);
            this.cbClienteOS.TabIndex = 20;
            this.cbClienteOS.ValueMember = "codPessoa";
            // 
            // tblPessoaBindingSource
            // 
            this.tblPessoaBindingSource.DataMember = "tblPessoa";
            this.tblPessoaBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // bdLojaInfoDataSet
            // 
            this.bdLojaInfoDataSet.DataSetName = "bdLojaInfoDataSet";
            this.bdLojaInfoDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // cbFuncOS
            // 
            this.cbFuncOS.DataSource = this.tblPessoaBindingSource1;
            this.cbFuncOS.DisplayMember = "nome";
            this.cbFuncOS.FormattingEnabled = true;
            this.cbFuncOS.Location = new System.Drawing.Point(134, 70);
            this.cbFuncOS.Name = "cbFuncOS";
            this.cbFuncOS.Size = new System.Drawing.Size(445, 21);
            this.cbFuncOS.TabIndex = 21;
            this.cbFuncOS.ValueMember = "codFuncionario";
            // 
            // tblPessoaBindingSource1
            // 
            this.tblPessoaBindingSource1.DataMember = "tblPessoa";
            this.tblPessoaBindingSource1.DataSource = this.bdLojaInfoDataSet;
            // 
            // cbServicoOS
            // 
            this.cbServicoOS.DataSource = this.tblTipoServicoBindingSource;
            this.cbServicoOS.DisplayMember = "nomeServico";
            this.cbServicoOS.FormattingEnabled = true;
            this.cbServicoOS.Location = new System.Drawing.Point(134, 97);
            this.cbServicoOS.Name = "cbServicoOS";
            this.cbServicoOS.Size = new System.Drawing.Size(445, 21);
            this.cbServicoOS.TabIndex = 22;
            this.cbServicoOS.ValueMember = "codTipoServico";
            // 
            // tblTipoServicoBindingSource
            // 
            this.tblTipoServicoBindingSource.DataMember = "tblTipoServico";
            this.tblTipoServicoBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tbValorOS
            // 
            this.tbValorOS.Location = new System.Drawing.Point(134, 268);
            this.tbValorOS.Name = "tbValorOS";
            this.tbValorOS.Size = new System.Drawing.Size(100, 20);
            this.tbValorOS.TabIndex = 23;
            // 
            // tblUnidadeBindingSource
            // 
            this.tblUnidadeBindingSource.DataMember = "tblUnidade";
            this.tblUnidadeBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tblPessoaTableAdapter
            // 
            this.tblPessoaTableAdapter.ClearBeforeFill = true;
            // 
            // fKtblFuncionariotblPessoa1BindingSource
            // 
            this.fKtblFuncionariotblPessoa1BindingSource.DataMember = "FK_tblFuncionario_tblPessoa1";
            this.fKtblFuncionariotblPessoa1BindingSource.DataSource = this.tblPessoaBindingSource1;
            // 
            // tblFuncionarioTableAdapter
            // 
            this.tblFuncionarioTableAdapter.ClearBeforeFill = true;
            // 
            // tblTipoServicoTableAdapter
            // 
            this.tblTipoServicoTableAdapter.ClearBeforeFill = true;
            // 
            // tblUnidadeTableAdapter
            // 
            this.tblUnidadeTableAdapter.ClearBeforeFill = true;
            // 
            // cadOS
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(593, 333);
            this.Controls.Add(this.tbValorOS);
            this.Controls.Add(this.cbServicoOS);
            this.Controls.Add(this.cbFuncOS);
            this.Controls.Add(this.cbClienteOS);
            this.Controls.Add(this.dtOS);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.tbObsOS);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadOS";
            this.Text = "Cadastro de Ordem de Serviço";
            this.Load += new System.EventHandler(this.cadOS_Load);
            ((System.ComponentModel.ISupportInitialize)(this.tblPessoaBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblPessoaBindingSource1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblTipoServicoBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblFuncionariotblPessoa1BindingSource)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.TextBox tbObsOS;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.DateTimePicker dtOS;
        private System.Windows.Forms.ComboBox cbClienteOS;
        private System.Windows.Forms.ComboBox cbFuncOS;
        private System.Windows.Forms.ComboBox cbServicoOS;
        private System.Windows.Forms.TextBox tbValorOS;
        private bdLojaInfoDataSet bdLojaInfoDataSet;
        private System.Windows.Forms.BindingSource tblPessoaBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblPessoaTableAdapter tblPessoaTableAdapter;
        private System.Windows.Forms.BindingSource tblPessoaBindingSource1;
        private System.Windows.Forms.BindingSource fKtblFuncionariotblPessoa1BindingSource;
        private bdLojaInfoDataSetTableAdapters.tblFuncionarioTableAdapter tblFuncionarioTableAdapter;
        private System.Windows.Forms.BindingSource tblTipoServicoBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblTipoServicoTableAdapter tblTipoServicoTableAdapter;
        private System.Windows.Forms.BindingSource tblUnidadeBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter tblUnidadeTableAdapter;
    }
}
namespace ProjetoIntegrador
{
    partial class cadFunc
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
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.dtFimFunc = new System.Windows.Forms.DateTimePicker();
            this.dtIniFunc = new System.Windows.Forms.DateTimePicker();
            this.tblUnidadeBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.bdLojaInfoDataSet = new ProjetoIntegrador.bdLojaInfoDataSet();
            this.tbSalarioFunc = new System.Windows.Forms.TextBox();
            this.tbSetorFunc = new System.Windows.Forms.TextBox();
            this.tbNomeFunc = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.button2 = new System.Windows.Forms.Button();
            this.tblUnidadeTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(39, 52);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(42, 18);
            this.label5.TabIndex = 6;
            this.label5.Text = "Setor:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(31, 76);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(50, 18);
            this.label1.TabIndex = 7;
            this.label1.Text = "Sálario:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(12, 100);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(72, 18);
            this.label2.TabIndex = 8;
            this.label2.Text = "Data Início:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(205, 100);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(62, 18);
            this.label3.TabIndex = 9;
            this.label3.Text = "Data Fim:";
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(217, 137);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 21;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(298, 137);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 20;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(136, 137);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 19;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            // 
            // dtFimFunc
            // 
            this.dtFimFunc.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtFimFunc.Location = new System.Drawing.Point(273, 100);
            this.dtFimFunc.Name = "dtFimFunc";
            this.dtFimFunc.Size = new System.Drawing.Size(100, 20);
            this.dtFimFunc.TabIndex = 22;
            // 
            // dtIniFunc
            // 
            this.dtIniFunc.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtIniFunc.Location = new System.Drawing.Point(90, 100);
            this.dtIniFunc.Name = "dtIniFunc";
            this.dtIniFunc.Size = new System.Drawing.Size(100, 20);
            this.dtIniFunc.TabIndex = 23;
            // 
            // tblUnidadeBindingSource
            // 
            this.tblUnidadeBindingSource.DataMember = "tblUnidade";
            this.tblUnidadeBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // bdLojaInfoDataSet
            // 
            this.bdLojaInfoDataSet.DataSetName = "bdLojaInfoDataSet";
            this.bdLojaInfoDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // tbSalarioFunc
            // 
            this.tbSalarioFunc.Location = new System.Drawing.Point(90, 74);
            this.tbSalarioFunc.Name = "tbSalarioFunc";
            this.tbSalarioFunc.Size = new System.Drawing.Size(100, 20);
            this.tbSalarioFunc.TabIndex = 25;
            // 
            // tbSetorFunc
            // 
            this.tbSetorFunc.Location = new System.Drawing.Point(90, 50);
            this.tbSetorFunc.Name = "tbSetorFunc";
            this.tbSetorFunc.Size = new System.Drawing.Size(282, 20);
            this.tbSetorFunc.TabIndex = 27;
            // 
            // tbNomeFunc
            // 
            this.tbNomeFunc.Location = new System.Drawing.Point(91, 24);
            this.tbNomeFunc.Name = "tbNomeFunc";
            this.tbNomeFunc.Size = new System.Drawing.Size(282, 20);
            this.tbNomeFunc.TabIndex = 28;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(37, 26);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(44, 18);
            this.label4.TabIndex = 29;
            this.label4.Text = "Nome:";
            // 
            // button2
            // 
            this.button2.Location = new System.Drawing.Point(55, 137);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(75, 23);
            this.button2.TabIndex = 31;
            this.button2.Text = "Buscar";
            this.button2.UseVisualStyleBackColor = true;
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // tblUnidadeTableAdapter
            // 
            this.tblUnidadeTableAdapter.ClearBeforeFill = true;
            // 
            // cadFunc
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(412, 186);
            this.Controls.Add(this.button2);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.tbNomeFunc);
            this.Controls.Add(this.tbSetorFunc);
            this.Controls.Add(this.tbSalarioFunc);
            this.Controls.Add(this.dtIniFunc);
            this.Controls.Add(this.dtFimFunc);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadFunc";
            this.Text = "Cadastro Funcionário";
            this.Load += new System.EventHandler(this.cadFunc_Load);
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.DateTimePicker dtFimFunc;
        private System.Windows.Forms.DateTimePicker dtIniFunc;
        private System.Windows.Forms.TextBox tbSalarioFunc;
        private System.Windows.Forms.TextBox tbSetorFunc;
        private System.Windows.Forms.TextBox tbNomeFunc;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button button2;
        private bdLojaInfoDataSet bdLojaInfoDataSet;
        private System.Windows.Forms.BindingSource tblUnidadeBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter tblUnidadeTableAdapter;
    }
}
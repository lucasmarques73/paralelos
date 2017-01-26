namespace ProjetoIntegrador
{
    partial class cadDesconto
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
            this.tblUnidadeBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.bdLojaInfoDataSet = new ProjetoIntegrador.bdLojaInfoDataSet();
            this.tbValorDesc = new System.Windows.Forms.TextBox();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.dtIniDesc = new System.Windows.Forms.DateTimePicker();
            this.dtFimDesc = new System.Windows.Forms.DateTimePicker();
            this.tbNomeDesc = new System.Windows.Forms.TextBox();
            this.bdLojaInfoDataSetBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblUnidadeTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSetBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(37, 18);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(44, 18);
            this.label5.TabIndex = 6;
            this.label5.Text = "Nome:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(12, 137);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(72, 18);
            this.label1.TabIndex = 7;
            this.label1.Text = "Data Inicio:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(19, 163);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(62, 18);
            this.label2.TabIndex = 8;
            this.label2.Text = "Data Fim:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(40, 185);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(41, 18);
            this.label3.TabIndex = 9;
            this.label3.Text = "Valor:";
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
            // tbValorDesc
            // 
            this.tbValorDesc.Location = new System.Drawing.Point(90, 185);
            this.tbValorDesc.Name = "tbValorDesc";
            this.tbValorDesc.Size = new System.Drawing.Size(144, 20);
            this.tbValorDesc.TabIndex = 25;
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(196, 226);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 29;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(277, 226);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 28;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(115, 226);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 27;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            // 
            // dtIniDesc
            // 
            this.dtIniDesc.Location = new System.Drawing.Point(90, 133);
            this.dtIniDesc.Name = "dtIniDesc";
            this.dtIniDesc.Size = new System.Drawing.Size(228, 20);
            this.dtIniDesc.TabIndex = 30;
            // 
            // dtFimDesc
            // 
            this.dtFimDesc.Location = new System.Drawing.Point(90, 159);
            this.dtFimDesc.Name = "dtFimDesc";
            this.dtFimDesc.Size = new System.Drawing.Size(228, 20);
            this.dtFimDesc.TabIndex = 31;
            // 
            // tbNomeDesc
            // 
            this.tbNomeDesc.Location = new System.Drawing.Point(88, 15);
            this.tbNomeDesc.Multiline = true;
            this.tbNomeDesc.Name = "tbNomeDesc";
            this.tbNomeDesc.Size = new System.Drawing.Size(230, 112);
            this.tbNomeDesc.TabIndex = 32;
            // 
            // bdLojaInfoDataSetBindingSource
            // 
            this.bdLojaInfoDataSetBindingSource.DataSource = this.bdLojaInfoDataSet;
            this.bdLojaInfoDataSetBindingSource.Position = 0;
            // 
            // tblUnidadeTableAdapter
            // 
            this.tblUnidadeTableAdapter.ClearBeforeFill = true;
            // 
            // cadDesconto
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(365, 261);
            this.Controls.Add(this.tbNomeDesc);
            this.Controls.Add(this.dtFimDesc);
            this.Controls.Add(this.dtIniDesc);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.tbValorDesc);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadDesconto";
            this.Text = "cadDesconto";
            this.Load += new System.EventHandler(this.cadDesconto_Load);
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSetBindingSource)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbValorDesc;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.DateTimePicker dtIniDesc;
        private System.Windows.Forms.DateTimePicker dtFimDesc;
        private System.Windows.Forms.TextBox tbNomeDesc;
        private System.Windows.Forms.BindingSource bdLojaInfoDataSetBindingSource;
        private bdLojaInfoDataSet bdLojaInfoDataSet;
        private System.Windows.Forms.BindingSource tblUnidadeBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter tblUnidadeTableAdapter;
    }
}
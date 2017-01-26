namespace provaVania20_11
{
    partial class cadOcorrencia
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
            this.tbLocal = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.tbDesc = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.dtData = new System.Windows.Forms.DateTimePicker();
            this.label3 = new System.Windows.Forms.Label();
            this.btSair = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btSalvarCad = new System.Windows.Forms.Button();
            this.fKtblOcorrenciatblCarroBindingSource2 = new System.Windows.Forms.BindingSource(this.components);
            this.tblCarroBindingSource1 = new System.Windows.Forms.BindingSource(this.components);
            this.bdProvaVaniaDataSet1 = new provaVania20_11.bdProvaVaniaDataSet1();
            this.tblCarroBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.bdProvaVaniaDataSet = new provaVania20_11.bdProvaVaniaDataSet();
            this.tblCarroTableAdapter = new provaVania20_11.bdProvaVaniaDataSetTableAdapters.tblCarroTableAdapter();
            this.fKtblOcorrenciatblCarroBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblOcorrenciaTableAdapter = new provaVania20_11.bdProvaVaniaDataSetTableAdapters.tblOcorrenciaTableAdapter();
            this.tblCarroTableAdapter1 = new provaVania20_11.bdProvaVaniaDataSet1TableAdapters.tblCarroTableAdapter();
            this.fKtblOcorrenciatblCarroBindingSource1 = new System.Windows.Forms.BindingSource(this.components);
            this.tblOcorrenciaTableAdapter1 = new provaVania20_11.bdProvaVaniaDataSet1TableAdapters.tblOcorrenciaTableAdapter();
            this.cbPlaca = new System.Windows.Forms.ComboBox();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource2)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCarroBindingSource1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdProvaVaniaDataSet1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCarroBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdProvaVaniaDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource1)).BeginInit();
            this.SuspendLayout();
            // 
            // tbLocal
            // 
            this.tbLocal.Location = new System.Drawing.Point(132, 12);
            this.tbLocal.Name = "tbLocal";
            this.tbLocal.Size = new System.Drawing.Size(343, 20);
            this.tbLocal.TabIndex = 80;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(13, 15);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(36, 13);
            this.label4.TabIndex = 79;
            this.label4.Text = "Local:";
            // 
            // tbDesc
            // 
            this.tbDesc.Location = new System.Drawing.Point(132, 64);
            this.tbDesc.Multiline = true;
            this.tbDesc.Name = "tbDesc";
            this.tbDesc.Size = new System.Drawing.Size(343, 68);
            this.tbDesc.TabIndex = 82;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(13, 67);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(58, 13);
            this.label1.TabIndex = 81;
            this.label1.Text = "Descrição:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(13, 41);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(37, 13);
            this.label2.TabIndex = 83;
            this.label2.Text = "Placa:";
            // 
            // dtData
            // 
            this.dtData.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtData.Location = new System.Drawing.Point(377, 38);
            this.dtData.Name = "dtData";
            this.dtData.Size = new System.Drawing.Size(98, 20);
            this.dtData.TabIndex = 86;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(307, 41);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(33, 13);
            this.label3.TabIndex = 85;
            this.label3.Text = "Data:";
            // 
            // btSair
            // 
            this.btSair.Location = new System.Drawing.Point(346, 161);
            this.btSair.Name = "btSair";
            this.btSair.Size = new System.Drawing.Size(75, 23);
            this.btSair.TabIndex = 89;
            this.btSair.Text = "Sair";
            this.btSair.UseVisualStyleBackColor = true;
            this.btSair.Click += new System.EventHandler(this.btSair_Click);
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(265, 161);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 88;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btSalvarCad
            // 
            this.btSalvarCad.Location = new System.Drawing.Point(184, 161);
            this.btSalvarCad.Name = "btSalvarCad";
            this.btSalvarCad.Size = new System.Drawing.Size(75, 23);
            this.btSalvarCad.TabIndex = 87;
            this.btSalvarCad.Text = "Salvar";
            this.btSalvarCad.UseVisualStyleBackColor = true;
            this.btSalvarCad.Click += new System.EventHandler(this.btSalvarCad_Click);
            // 
            // fKtblOcorrenciatblCarroBindingSource2
            // 
            this.fKtblOcorrenciatblCarroBindingSource2.DataMember = "FK_tblOcorrencia_tblCarro";
            this.fKtblOcorrenciatblCarroBindingSource2.DataSource = this.tblCarroBindingSource1;
            // 
            // tblCarroBindingSource1
            // 
            this.tblCarroBindingSource1.DataMember = "tblCarro";
            this.tblCarroBindingSource1.DataSource = this.bdProvaVaniaDataSet1;
            // 
            // bdProvaVaniaDataSet1
            // 
            this.bdProvaVaniaDataSet1.DataSetName = "bdProvaVaniaDataSet1";
            this.bdProvaVaniaDataSet1.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // tblCarroBindingSource
            // 
            this.tblCarroBindingSource.DataMember = "tblCarro";
            this.tblCarroBindingSource.DataSource = this.bdProvaVaniaDataSet;
            // 
            // bdProvaVaniaDataSet
            // 
            this.bdProvaVaniaDataSet.DataSetName = "bdProvaVaniaDataSet";
            this.bdProvaVaniaDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema;
            // 
            // tblCarroTableAdapter
            // 
            this.tblCarroTableAdapter.ClearBeforeFill = true;
            // 
            // fKtblOcorrenciatblCarroBindingSource
            // 
            this.fKtblOcorrenciatblCarroBindingSource.DataMember = "FK_tblOcorrencia_tblCarro";
            this.fKtblOcorrenciatblCarroBindingSource.DataSource = this.tblCarroBindingSource;
            // 
            // tblOcorrenciaTableAdapter
            // 
            this.tblOcorrenciaTableAdapter.ClearBeforeFill = true;
            // 
            // tblCarroTableAdapter1
            // 
            this.tblCarroTableAdapter1.ClearBeforeFill = true;
            // 
            // fKtblOcorrenciatblCarroBindingSource1
            // 
            this.fKtblOcorrenciatblCarroBindingSource1.DataMember = "FK_tblOcorrencia_tblCarro";
            this.fKtblOcorrenciatblCarroBindingSource1.DataSource = this.tblCarroBindingSource1;
            // 
            // tblOcorrenciaTableAdapter1
            // 
            this.tblOcorrenciaTableAdapter1.ClearBeforeFill = true;
            // 
            // cbPlaca
            // 
            this.cbPlaca.DataSource = this.tblCarroBindingSource1;
            this.cbPlaca.DisplayMember = "placa";
            this.cbPlaca.FormattingEnabled = true;
            this.cbPlaca.Location = new System.Drawing.Point(132, 38);
            this.cbPlaca.Name = "cbPlaca";
            this.cbPlaca.Size = new System.Drawing.Size(149, 21);
            this.cbPlaca.TabIndex = 90;
            this.cbPlaca.ValueMember = "placa";
            // 
            // cadOcorrencia
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(534, 220);
            this.Controls.Add(this.cbPlaca);
            this.Controls.Add(this.btSair);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvarCad);
            this.Controls.Add(this.dtData);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.tbDesc);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.tbLocal);
            this.Controls.Add(this.label4);
            this.Name = "cadOcorrencia";
            this.Text = "cadOcorrencia";
            this.Load += new System.EventHandler(this.cadOcorrencia_Load);
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource2)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCarroBindingSource1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdProvaVaniaDataSet1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCarroBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdProvaVaniaDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.fKtblOcorrenciatblCarroBindingSource1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tbLocal;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox tbDesc;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.DateTimePicker dtData;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button btSair;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btSalvarCad;
        private bdProvaVaniaDataSet bdProvaVaniaDataSet;
        private System.Windows.Forms.BindingSource tblCarroBindingSource;
        private bdProvaVaniaDataSetTableAdapters.tblCarroTableAdapter tblCarroTableAdapter;
        private System.Windows.Forms.BindingSource fKtblOcorrenciatblCarroBindingSource;
        private bdProvaVaniaDataSetTableAdapters.tblOcorrenciaTableAdapter tblOcorrenciaTableAdapter;
        private bdProvaVaniaDataSet1 bdProvaVaniaDataSet1;
        private System.Windows.Forms.BindingSource tblCarroBindingSource1;
        private bdProvaVaniaDataSet1TableAdapters.tblCarroTableAdapter tblCarroTableAdapter1;
        private System.Windows.Forms.BindingSource fKtblOcorrenciatblCarroBindingSource1;
        private bdProvaVaniaDataSet1TableAdapters.tblOcorrenciaTableAdapter tblOcorrenciaTableAdapter1;
        private System.Windows.Forms.BindingSource fKtblOcorrenciatblCarroBindingSource2;
        private System.Windows.Forms.ComboBox cbPlaca;
    }
}
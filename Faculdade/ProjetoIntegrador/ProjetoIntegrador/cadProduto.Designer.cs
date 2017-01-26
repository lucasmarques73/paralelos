namespace ProjetoIntegrador
{
    partial class cadProduto
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
            this.label7 = new System.Windows.Forms.Label();
            this.label8 = new System.Windows.Forms.Label();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.cbUnidadeProd = new System.Windows.Forms.ComboBox();
            this.tblUnidadeBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.bdLojaInfoDataSet = new ProjetoIntegrador.bdLojaInfoDataSet();
            this.tbQtEstoque = new System.Windows.Forms.TextBox();
            this.tbValorVenda = new System.Windows.Forms.TextBox();
            this.tbValorCusto = new System.Windows.Forms.TextBox();
            this.cbDesconProd = new System.Windows.Forms.ComboBox();
            this.tblDescontoBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tbDescProd = new System.Windows.Forms.TextBox();
            this.tbNomeProd = new System.Windows.Forms.TextBox();
            this.cbCatProd = new System.Windows.Forms.ComboBox();
            this.tblCategoriaBindingSource1 = new System.Windows.Forms.BindingSource(this.components);
            this.tblCategoriaBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.cbFornProd = new System.Windows.Forms.ComboBox();
            this.tblFornecedorBindingSource = new System.Windows.Forms.BindingSource(this.components);
            this.tblCategoriaTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblCategoriaTableAdapter();
            this.tblFornecedorTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblFornecedorTableAdapter();
            this.tblDescontoTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblDescontoTableAdapter();
            this.tblUnidadeTableAdapter = new ProjetoIntegrador.bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter();
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblDescontoBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCategoriaBindingSource1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCategoriaBindingSource)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblFornecedorBindingSource)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(69, 49);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(44, 18);
            this.label5.TabIndex = 6;
            this.label5.Text = "Nome:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(47, 75);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(66, 18);
            this.label1.TabIndex = 7;
            this.label1.Text = "Descrição:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(38, 177);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(76, 18);
            this.label2.TabIndex = 8;
            this.label2.Text = "Valor Custo:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(35, 203);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(79, 18);
            this.label3.TabIndex = 9;
            this.label3.Text = "Valor Venda:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(38, 229);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(75, 18);
            this.label4.TabIndex = 10;
            this.label4.Text = "Qt Estoque:";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label6.Location = new System.Drawing.Point(341, 177);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(65, 18);
            this.label6.TabIndex = 11;
            this.label6.Text = "Categoria:";
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label7.Location = new System.Drawing.Point(330, 203);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(76, 18);
            this.label7.TabIndex = 12;
            this.label7.Text = "Fornecedor:";
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label8.Location = new System.Drawing.Point(49, 256);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(64, 18);
            this.label8.TabIndex = 13;
            this.label8.Text = "Desconto:";
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(458, 311);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 21;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(539, 311);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 20;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(377, 311);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 19;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            this.btSalvarOS.Click += new System.EventHandler(this.btSalvarOS_Click);
            // 
            // cbUnidadeProd
            // 
            this.cbUnidadeProd.DataSource = this.tblUnidadeBindingSource;
            this.cbUnidadeProd.DisplayMember = "nomeUnidade";
            this.cbUnidadeProd.FormattingEnabled = true;
            this.cbUnidadeProd.Location = new System.Drawing.Point(237, 228);
            this.cbUnidadeProd.Name = "cbUnidadeProd";
            this.cbUnidadeProd.Size = new System.Drawing.Size(78, 21);
            this.cbUnidadeProd.TabIndex = 26;
            this.cbUnidadeProd.ValueMember = "codUnidade";
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
            // tbQtEstoque
            // 
            this.tbQtEstoque.Location = new System.Drawing.Point(130, 228);
            this.tbQtEstoque.Name = "tbQtEstoque";
            this.tbQtEstoque.Size = new System.Drawing.Size(100, 20);
            this.tbQtEstoque.TabIndex = 25;
            // 
            // tbValorVenda
            // 
            this.tbValorVenda.Location = new System.Drawing.Point(130, 202);
            this.tbValorVenda.Name = "tbValorVenda";
            this.tbValorVenda.Size = new System.Drawing.Size(100, 20);
            this.tbValorVenda.TabIndex = 27;
            // 
            // tbValorCusto
            // 
            this.tbValorCusto.Location = new System.Drawing.Point(130, 176);
            this.tbValorCusto.Name = "tbValorCusto";
            this.tbValorCusto.Size = new System.Drawing.Size(100, 20);
            this.tbValorCusto.TabIndex = 29;
            // 
            // cbDesconProd
            // 
            this.cbDesconProd.DataSource = this.tblDescontoBindingSource;
            this.cbDesconProd.DisplayMember = "nomeDesconto";
            this.cbDesconProd.FormattingEnabled = true;
            this.cbDesconProd.Location = new System.Drawing.Point(130, 256);
            this.cbDesconProd.Name = "cbDesconProd";
            this.cbDesconProd.Size = new System.Drawing.Size(185, 21);
            this.cbDesconProd.TabIndex = 31;
            this.cbDesconProd.ValueMember = "codDesconto";
            // 
            // tblDescontoBindingSource
            // 
            this.tblDescontoBindingSource.DataMember = "tblDesconto";
            this.tblDescontoBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tbDescProd
            // 
            this.tbDescProd.Location = new System.Drawing.Point(130, 74);
            this.tbDescProd.Multiline = true;
            this.tbDescProd.Name = "tbDescProd";
            this.tbDescProd.Size = new System.Drawing.Size(484, 96);
            this.tbDescProd.TabIndex = 32;
            // 
            // tbNomeProd
            // 
            this.tbNomeProd.Location = new System.Drawing.Point(130, 48);
            this.tbNomeProd.Name = "tbNomeProd";
            this.tbNomeProd.Size = new System.Drawing.Size(484, 20);
            this.tbNomeProd.TabIndex = 33;
            // 
            // cbCatProd
            // 
            this.cbCatProd.DataSource = this.tblCategoriaBindingSource1;
            this.cbCatProd.DisplayMember = "nomeCategoria";
            this.cbCatProd.FormattingEnabled = true;
            this.cbCatProd.Location = new System.Drawing.Point(412, 177);
            this.cbCatProd.Name = "cbCatProd";
            this.cbCatProd.Size = new System.Drawing.Size(202, 21);
            this.cbCatProd.TabIndex = 34;
            this.cbCatProd.ValueMember = "codCategoria";
            // 
            // tblCategoriaBindingSource1
            // 
            this.tblCategoriaBindingSource1.DataMember = "tblCategoria";
            this.tblCategoriaBindingSource1.DataSource = this.bdLojaInfoDataSet;
            // 
            // tblCategoriaBindingSource
            // 
            this.tblCategoriaBindingSource.DataMember = "tblCategoria";
            this.tblCategoriaBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // cbFornProd
            // 
            this.cbFornProd.DataSource = this.tblFornecedorBindingSource;
            this.cbFornProd.DisplayMember = "nomeFornecedor";
            this.cbFornProd.FormattingEnabled = true;
            this.cbFornProd.Location = new System.Drawing.Point(412, 204);
            this.cbFornProd.Name = "cbFornProd";
            this.cbFornProd.Size = new System.Drawing.Size(202, 21);
            this.cbFornProd.TabIndex = 35;
            this.cbFornProd.ValueMember = "codFornecedor";
            // 
            // tblFornecedorBindingSource
            // 
            this.tblFornecedorBindingSource.DataMember = "tblFornecedor";
            this.tblFornecedorBindingSource.DataSource = this.bdLojaInfoDataSet;
            // 
            // tblCategoriaTableAdapter
            // 
            this.tblCategoriaTableAdapter.ClearBeforeFill = true;
            // 
            // tblFornecedorTableAdapter
            // 
            this.tblFornecedorTableAdapter.ClearBeforeFill = true;
            // 
            // tblDescontoTableAdapter
            // 
            this.tblDescontoTableAdapter.ClearBeforeFill = true;
            // 
            // tblUnidadeTableAdapter
            // 
            this.tblUnidadeTableAdapter.ClearBeforeFill = true;
            // 
            // cadProduto
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(630, 346);
            this.Controls.Add(this.cbFornProd);
            this.Controls.Add(this.cbCatProd);
            this.Controls.Add(this.tbNomeProd);
            this.Controls.Add(this.tbDescProd);
            this.Controls.Add(this.cbDesconProd);
            this.Controls.Add(this.tbValorCusto);
            this.Controls.Add(this.tbValorVenda);
            this.Controls.Add(this.cbUnidadeProd);
            this.Controls.Add(this.tbQtEstoque);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.label8);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadProduto";
            this.Text = "cadProduto";
            this.Load += new System.EventHandler(this.cadProduto_Load);
            ((System.ComponentModel.ISupportInitialize)(this.tblUnidadeBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.bdLojaInfoDataSet)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblDescontoBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCategoriaBindingSource1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblCategoriaBindingSource)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tblFornecedorBindingSource)).EndInit();
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
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.ComboBox cbUnidadeProd;
        private System.Windows.Forms.TextBox tbQtEstoque;
        private System.Windows.Forms.TextBox tbValorVenda;
        private System.Windows.Forms.TextBox tbValorCusto;
        private System.Windows.Forms.ComboBox cbDesconProd;
        private System.Windows.Forms.TextBox tbDescProd;
        private System.Windows.Forms.TextBox tbNomeProd;
        private System.Windows.Forms.ComboBox cbCatProd;
        private System.Windows.Forms.ComboBox cbFornProd;
        private bdLojaInfoDataSet bdLojaInfoDataSet;
        private System.Windows.Forms.BindingSource tblCategoriaBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblCategoriaTableAdapter tblCategoriaTableAdapter;
        private System.Windows.Forms.BindingSource tblCategoriaBindingSource1;
        private System.Windows.Forms.BindingSource tblFornecedorBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblFornecedorTableAdapter tblFornecedorTableAdapter;
        private System.Windows.Forms.BindingSource tblDescontoBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblDescontoTableAdapter tblDescontoTableAdapter;
        private System.Windows.Forms.BindingSource tblUnidadeBindingSource;
        private bdLojaInfoDataSetTableAdapters.tblUnidadeTableAdapter tblUnidadeTableAdapter;
    }
}
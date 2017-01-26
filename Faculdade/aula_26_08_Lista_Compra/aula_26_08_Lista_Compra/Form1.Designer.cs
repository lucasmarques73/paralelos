namespace aula_26_08_Lista_Compra
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
            this.lbProduto = new System.Windows.Forms.Label();
            this.lbQuantidadde = new System.Windows.Forms.Label();
            this.lbValor = new System.Windows.Forms.Label();
            this.cbProduto = new System.Windows.Forms.ComboBox();
            this.tbQuantidade = new System.Windows.Forms.TextBox();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btFechar = new System.Windows.Forms.Button();
            this.btSalvar = new System.Windows.Forms.Button();
            this.dgListaCompra = new System.Windows.Forms.DataGridView();
            this.dtgProduto = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dtgQuantidade = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dtgValor = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.lbValorTotal = new System.Windows.Forms.Label();
            this.tbValorUni = new System.Windows.Forms.TextBox();
            this.tbValorTotal = new System.Windows.Forms.TextBox();
            this.btExcluir = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dgListaCompra)).BeginInit();
            this.SuspendLayout();
            // 
            // lbProduto
            // 
            this.lbProduto.AutoSize = true;
            this.lbProduto.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbProduto.Location = new System.Drawing.Point(12, 9);
            this.lbProduto.Name = "lbProduto";
            this.lbProduto.Size = new System.Drawing.Size(72, 20);
            this.lbProduto.TabIndex = 0;
            this.lbProduto.Text = "Produto";
            // 
            // lbQuantidadde
            // 
            this.lbQuantidadde.AutoSize = true;
            this.lbQuantidadde.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbQuantidadde.Location = new System.Drawing.Point(12, 40);
            this.lbQuantidadde.Name = "lbQuantidadde";
            this.lbQuantidadde.Size = new System.Drawing.Size(102, 20);
            this.lbQuantidadde.TabIndex = 1;
            this.lbQuantidadde.Text = "Quantidade";
            this.lbQuantidadde.Click += new System.EventHandler(this.lbQuantidadde_Click);
            // 
            // lbValor
            // 
            this.lbValor.AutoSize = true;
            this.lbValor.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbValor.Location = new System.Drawing.Point(12, 71);
            this.lbValor.Name = "lbValor";
            this.lbValor.Size = new System.Drawing.Size(88, 20);
            this.lbValor.TabIndex = 2;
            this.lbValor.Text = "Valor Uni.";
            // 
            // cbProduto
            // 
            this.cbProduto.FormattingEnabled = true;
            this.cbProduto.Items.AddRange(new object[] {
            "Arroz",
            "Feijão",
            "Leite",
            "Pão",
            "Manteiga",
            "Suco",
            "Batata"});
            this.cbProduto.Location = new System.Drawing.Point(134, 9);
            this.cbProduto.Name = "cbProduto";
            this.cbProduto.Size = new System.Drawing.Size(286, 21);
            this.cbProduto.TabIndex = 3;
            // 
            // tbQuantidade
            // 
            this.tbQuantidade.Location = new System.Drawing.Point(134, 40);
            this.tbQuantidade.Name = "tbQuantidade";
            this.tbQuantidade.Size = new System.Drawing.Size(77, 20);
            this.tbQuantidade.TabIndex = 4;
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(433, 40);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 18;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btFechar
            // 
            this.btFechar.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btFechar.Location = new System.Drawing.Point(433, 101);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 19;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = true;
            this.btFechar.Click += new System.EventHandler(this.btFechar_Click);
            // 
            // btSalvar
            // 
            this.btSalvar.BackColor = System.Drawing.Color.Transparent;
            this.btSalvar.Location = new System.Drawing.Point(433, 11);
            this.btSalvar.Name = "btSalvar";
            this.btSalvar.Size = new System.Drawing.Size(75, 23);
            this.btSalvar.TabIndex = 20;
            this.btSalvar.Text = "Salvar";
            this.btSalvar.UseVisualStyleBackColor = false;
            this.btSalvar.Click += new System.EventHandler(this.btSalvar_Click);
            // 
            // dgListaCompra
            // 
            this.dgListaCompra.AllowUserToDeleteRows = false;
            this.dgListaCompra.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgListaCompra.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.dtgProduto,
            this.dtgQuantidade,
            this.dtgValor});
            this.dgListaCompra.Location = new System.Drawing.Point(134, 130);
            this.dgListaCompra.Name = "dgListaCompra";
            this.dgListaCompra.ReadOnly = true;
            this.dgListaCompra.Size = new System.Drawing.Size(374, 150);
            this.dgListaCompra.TabIndex = 21;
            this.dgListaCompra.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView1_CellContentClick);
            // 
            // dtgProduto
            // 
            this.dtgProduto.HeaderText = "Produto";
            this.dtgProduto.Name = "dtgProduto";
            this.dtgProduto.ReadOnly = true;
            this.dtgProduto.Width = 250;
            // 
            // dtgQuantidade
            // 
            this.dtgQuantidade.HeaderText = "Quantidade";
            this.dtgQuantidade.Name = "dtgQuantidade";
            this.dtgQuantidade.ReadOnly = true;
            this.dtgQuantidade.Width = 30;
            // 
            // dtgValor
            // 
            this.dtgValor.HeaderText = "Valor";
            this.dtgValor.Name = "dtgValor";
            this.dtgValor.ReadOnly = true;
            this.dtgValor.Width = 50;
            // 
            // lbValorTotal
            // 
            this.lbValorTotal.AutoSize = true;
            this.lbValorTotal.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbValorTotal.Location = new System.Drawing.Point(332, 293);
            this.lbValorTotal.Name = "lbValorTotal";
            this.lbValorTotal.Size = new System.Drawing.Size(96, 20);
            this.lbValorTotal.TabIndex = 22;
            this.lbValorTotal.Text = "Valor Total";
            // 
            // tbValorUni
            // 
            this.tbValorUni.Location = new System.Drawing.Point(134, 71);
            this.tbValorUni.Name = "tbValorUni";
            this.tbValorUni.Size = new System.Drawing.Size(77, 20);
            this.tbValorUni.TabIndex = 23;
            // 
            // tbValorTotal
            // 
            this.tbValorTotal.Location = new System.Drawing.Point(434, 293);
            this.tbValorTotal.Name = "tbValorTotal";
            this.tbValorTotal.Size = new System.Drawing.Size(74, 20);
            this.tbValorTotal.TabIndex = 24;
            this.tbValorTotal.TextChanged += new System.EventHandler(this.tbValorTotal_TextChanged);
            // 
            // btExcluir
            // 
            this.btExcluir.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btExcluir.Location = new System.Drawing.Point(433, 72);
            this.btExcluir.Name = "btExcluir";
            this.btExcluir.Size = new System.Drawing.Size(75, 23);
            this.btExcluir.TabIndex = 25;
            this.btExcluir.Text = "Excluir";
            this.btExcluir.UseVisualStyleBackColor = true;
            this.btExcluir.Click += new System.EventHandler(this.btExcluir_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(548, 332);
            this.Controls.Add(this.btExcluir);
            this.Controls.Add(this.tbValorTotal);
            this.Controls.Add(this.tbValorUni);
            this.Controls.Add(this.lbValorTotal);
            this.Controls.Add(this.dgListaCompra);
            this.Controls.Add(this.btSalvar);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.tbQuantidade);
            this.Controls.Add(this.cbProduto);
            this.Controls.Add(this.lbValor);
            this.Controls.Add(this.lbQuantidadde);
            this.Controls.Add(this.lbProduto);
            this.Name = "Form1";
            this.Text = "Lista de Compra";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dgListaCompra)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lbProduto;
        private System.Windows.Forms.Label lbQuantidadde;
        private System.Windows.Forms.Label lbValor;
        private System.Windows.Forms.ComboBox cbProduto;
        private System.Windows.Forms.TextBox tbQuantidade;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btFechar;
        private System.Windows.Forms.Button btSalvar;
        private System.Windows.Forms.DataGridView dgListaCompra;
        private System.Windows.Forms.Label lbValorTotal;
        private System.Windows.Forms.DataGridViewTextBoxColumn dtgProduto;
        private System.Windows.Forms.DataGridViewTextBoxColumn dtgQuantidade;
        private System.Windows.Forms.DataGridViewTextBoxColumn dtgValor;
        private System.Windows.Forms.TextBox tbValorUni;
        private System.Windows.Forms.TextBox tbValorTotal;
        private System.Windows.Forms.Button btExcluir;
    }
}


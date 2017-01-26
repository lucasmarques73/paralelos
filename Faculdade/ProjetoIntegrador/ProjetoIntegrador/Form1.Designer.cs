namespace ProjetoIntegrador
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.btAddPessoa = new System.Windows.Forms.Button();
            this.btAddForn = new System.Windows.Forms.Button();
            this.btAddProd = new System.Windows.Forms.Button();
            this.btAddVenda = new System.Windows.Forms.Button();
            this.btAddAten = new System.Windows.Forms.Button();
            this.btBuscPessoa = new System.Windows.Forms.Button();
            this.btBuscForn = new System.Windows.Forms.Button();
            this.btBuscProd = new System.Windows.Forms.Button();
            this.btBuscVenda = new System.Windows.Forms.Button();
            this.btBuscAten = new System.Windows.Forms.Button();
            this.btOutros = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // btAddPessoa
            // 
            this.btAddPessoa.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btAddPessoa.BackgroundImage")));
            this.btAddPessoa.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btAddPessoa.Location = new System.Drawing.Point(21, 12);
            this.btAddPessoa.Name = "btAddPessoa";
            this.btAddPessoa.Size = new System.Drawing.Size(75, 41);
            this.btAddPessoa.TabIndex = 0;
            this.btAddPessoa.Text = "Cadastrar Pessoa";
            this.btAddPessoa.UseVisualStyleBackColor = true;
            this.btAddPessoa.Click += new System.EventHandler(this.btAddPessoa_Click);
            // 
            // btAddForn
            // 
            this.btAddForn.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btAddForn.BackgroundImage")));
            this.btAddForn.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btAddForn.Location = new System.Drawing.Point(21, 106);
            this.btAddForn.Name = "btAddForn";
            this.btAddForn.Size = new System.Drawing.Size(75, 41);
            this.btAddForn.TabIndex = 1;
            this.btAddForn.Text = "Cadastrar Fornecedor";
            this.btAddForn.UseVisualStyleBackColor = true;
            this.btAddForn.Click += new System.EventHandler(this.btAddForn_Click);
            // 
            // btAddProd
            // 
            this.btAddProd.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btAddProd.BackgroundImage")));
            this.btAddProd.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btAddProd.Location = new System.Drawing.Point(138, 12);
            this.btAddProd.Name = "btAddProd";
            this.btAddProd.Size = new System.Drawing.Size(75, 41);
            this.btAddProd.TabIndex = 2;
            this.btAddProd.Text = "Cadastrar Produto";
            this.btAddProd.UseVisualStyleBackColor = true;
            this.btAddProd.Click += new System.EventHandler(this.btAddProd_Click);
            // 
            // btAddVenda
            // 
            this.btAddVenda.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btAddVenda.BackgroundImage")));
            this.btAddVenda.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btAddVenda.Location = new System.Drawing.Point(138, 106);
            this.btAddVenda.Name = "btAddVenda";
            this.btAddVenda.Size = new System.Drawing.Size(75, 41);
            this.btAddVenda.TabIndex = 3;
            this.btAddVenda.Text = "Cadastrar Venda";
            this.btAddVenda.UseVisualStyleBackColor = true;
            this.btAddVenda.Click += new System.EventHandler(this.btAddVenda_Click);
            // 
            // btAddAten
            // 
            this.btAddAten.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btAddAten.BackgroundImage")));
            this.btAddAten.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btAddAten.Location = new System.Drawing.Point(253, 12);
            this.btAddAten.Name = "btAddAten";
            this.btAddAten.Size = new System.Drawing.Size(79, 41);
            this.btAddAten.TabIndex = 4;
            this.btAddAten.Text = "Cadastrar Atendimento";
            this.btAddAten.UseVisualStyleBackColor = true;
            this.btAddAten.Click += new System.EventHandler(this.btAddAten_Click);
            // 
            // btBuscPessoa
            // 
            this.btBuscPessoa.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btBuscPessoa.BackgroundImage")));
            this.btBuscPessoa.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btBuscPessoa.Location = new System.Drawing.Point(21, 59);
            this.btBuscPessoa.Name = "btBuscPessoa";
            this.btBuscPessoa.Size = new System.Drawing.Size(75, 41);
            this.btBuscPessoa.TabIndex = 5;
            this.btBuscPessoa.Text = "Buscar Pessoa";
            this.btBuscPessoa.UseVisualStyleBackColor = true;
            this.btBuscPessoa.Click += new System.EventHandler(this.btBuscPessoa_Click);
            // 
            // btBuscForn
            // 
            this.btBuscForn.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btBuscForn.BackgroundImage")));
            this.btBuscForn.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btBuscForn.Location = new System.Drawing.Point(21, 153);
            this.btBuscForn.Name = "btBuscForn";
            this.btBuscForn.Size = new System.Drawing.Size(75, 41);
            this.btBuscForn.TabIndex = 6;
            this.btBuscForn.Text = "Buscar Fornecedor";
            this.btBuscForn.UseVisualStyleBackColor = true;
            // 
            // btBuscProd
            // 
            this.btBuscProd.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btBuscProd.BackgroundImage")));
            this.btBuscProd.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btBuscProd.Location = new System.Drawing.Point(138, 59);
            this.btBuscProd.Name = "btBuscProd";
            this.btBuscProd.Size = new System.Drawing.Size(75, 41);
            this.btBuscProd.TabIndex = 7;
            this.btBuscProd.Text = "Buscar Produto";
            this.btBuscProd.UseVisualStyleBackColor = true;
            // 
            // btBuscVenda
            // 
            this.btBuscVenda.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btBuscVenda.BackgroundImage")));
            this.btBuscVenda.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btBuscVenda.Location = new System.Drawing.Point(138, 153);
            this.btBuscVenda.Name = "btBuscVenda";
            this.btBuscVenda.Size = new System.Drawing.Size(75, 41);
            this.btBuscVenda.TabIndex = 8;
            this.btBuscVenda.Text = "Buscar Venda";
            this.btBuscVenda.UseVisualStyleBackColor = true;
            // 
            // btBuscAten
            // 
            this.btBuscAten.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btBuscAten.BackgroundImage")));
            this.btBuscAten.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btBuscAten.Location = new System.Drawing.Point(253, 59);
            this.btBuscAten.Name = "btBuscAten";
            this.btBuscAten.Size = new System.Drawing.Size(79, 41);
            this.btBuscAten.TabIndex = 9;
            this.btBuscAten.Text = "Buscar Atendimento";
            this.btBuscAten.UseVisualStyleBackColor = true;
            // 
            // btOutros
            // 
            this.btOutros.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btOutros.BackgroundImage")));
            this.btOutros.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btOutros.Location = new System.Drawing.Point(253, 106);
            this.btOutros.Name = "btOutros";
            this.btOutros.Size = new System.Drawing.Size(79, 41);
            this.btOutros.TabIndex = 10;
            this.btOutros.Text = "Outros Serviços";
            this.btOutros.UseVisualStyleBackColor = true;
            this.btOutros.Click += new System.EventHandler(this.btOutros_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(437, 284);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 18;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(524, 319);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btOutros);
            this.Controls.Add(this.btBuscAten);
            this.Controls.Add(this.btBuscVenda);
            this.Controls.Add(this.btBuscProd);
            this.Controls.Add(this.btBuscForn);
            this.Controls.Add(this.btBuscPessoa);
            this.Controls.Add(this.btAddAten);
            this.Controls.Add(this.btAddVenda);
            this.Controls.Add(this.btAddProd);
            this.Controls.Add(this.btAddForn);
            this.Controls.Add(this.btAddPessoa);
            this.Name = "Form1";
            this.Text = "Form1";
            this.WindowState = System.Windows.Forms.FormWindowState.Maximized;
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button btAddPessoa;
        private System.Windows.Forms.Button btAddForn;
        private System.Windows.Forms.Button btAddProd;
        private System.Windows.Forms.Button btAddVenda;
        private System.Windows.Forms.Button btAddAten;
        private System.Windows.Forms.Button btBuscPessoa;
        private System.Windows.Forms.Button btBuscForn;
        private System.Windows.Forms.Button btBuscProd;
        private System.Windows.Forms.Button btBuscVenda;
        private System.Windows.Forms.Button btBuscAten;
        private System.Windows.Forms.Button btOutros;
        private System.Windows.Forms.Button btSairOS;
    }
}


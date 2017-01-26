namespace ProjetoIntegrador
{
    partial class cadVenda
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
            this.label5 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.dtVenda = new System.Windows.Forms.DateTimePicker();
            this.btLimparOS = new System.Windows.Forms.Button();
            this.btSairOS = new System.Windows.Forms.Button();
            this.btSalvarOS = new System.Windows.Forms.Button();
            this.tbValorTotal = new System.Windows.Forms.TextBox();
            this.tbValorDesc = new System.Windows.Forms.TextBox();
            this.tbValorPagar = new System.Windows.Forms.TextBox();
            this.dataGridView1 = new System.Windows.Forms.DataGridView();
            this.Qtdade = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Produto = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.ValorTotalProduto = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.btAddProd = new System.Windows.Forms.Button();
            this.btRemProd = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).BeginInit();
            this.SuspendLayout();
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(97, 16);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(37, 18);
            this.label5.TabIndex = 7;
            this.label5.Text = "Data:";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(22, 47);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(111, 18);
            this.label1.TabIndex = 8;
            this.label1.Text = "Lista de Produtos:";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(62, 199);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(72, 18);
            this.label2.TabIndex = 9;
            this.label2.Text = "Valor Total:";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(37, 225);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(97, 18);
            this.label3.TabIndex = 10;
            this.label3.Text = "Valor Desconto:";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Trebuchet MS", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(51, 251);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(83, 18);
            this.label4.TabIndex = 11;
            this.label4.Text = "Total à pagar:";
            // 
            // dtVenda
            // 
            this.dtVenda.Location = new System.Drawing.Point(140, 12);
            this.dtVenda.Name = "dtVenda";
            this.dtVenda.Size = new System.Drawing.Size(228, 20);
            this.dtVenda.TabIndex = 20;
            // 
            // btLimparOS
            // 
            this.btLimparOS.Location = new System.Drawing.Point(492, 268);
            this.btLimparOS.Name = "btLimparOS";
            this.btLimparOS.Size = new System.Drawing.Size(75, 23);
            this.btLimparOS.TabIndex = 23;
            this.btLimparOS.Text = "Limpar";
            this.btLimparOS.UseVisualStyleBackColor = true;
            this.btLimparOS.Click += new System.EventHandler(this.btLimparOS_Click);
            // 
            // btSairOS
            // 
            this.btSairOS.Location = new System.Drawing.Point(573, 268);
            this.btSairOS.Name = "btSairOS";
            this.btSairOS.Size = new System.Drawing.Size(75, 23);
            this.btSairOS.TabIndex = 22;
            this.btSairOS.Text = "Sair";
            this.btSairOS.UseVisualStyleBackColor = true;
            this.btSairOS.Click += new System.EventHandler(this.btSairOS_Click);
            // 
            // btSalvarOS
            // 
            this.btSalvarOS.Location = new System.Drawing.Point(411, 268);
            this.btSalvarOS.Name = "btSalvarOS";
            this.btSalvarOS.Size = new System.Drawing.Size(75, 23);
            this.btSalvarOS.TabIndex = 21;
            this.btSalvarOS.Text = "Salvar";
            this.btSalvarOS.UseVisualStyleBackColor = true;
            // 
            // tbValorTotal
            // 
            this.tbValorTotal.Location = new System.Drawing.Point(140, 198);
            this.tbValorTotal.Name = "tbValorTotal";
            this.tbValorTotal.Size = new System.Drawing.Size(100, 20);
            this.tbValorTotal.TabIndex = 25;
            // 
            // tbValorDesc
            // 
            this.tbValorDesc.Location = new System.Drawing.Point(140, 224);
            this.tbValorDesc.Name = "tbValorDesc";
            this.tbValorDesc.Size = new System.Drawing.Size(100, 20);
            this.tbValorDesc.TabIndex = 27;
            // 
            // tbValorPagar
            // 
            this.tbValorPagar.Location = new System.Drawing.Point(140, 250);
            this.tbValorPagar.Name = "tbValorPagar";
            this.tbValorPagar.Size = new System.Drawing.Size(100, 20);
            this.tbValorPagar.TabIndex = 29;
            // 
            // dataGridView1
            // 
            this.dataGridView1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView1.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.Qtdade,
            this.Produto,
            this.ValorTotalProduto});
            this.dataGridView1.Location = new System.Drawing.Point(139, 38);
            this.dataGridView1.Name = "dataGridView1";
            this.dataGridView1.Size = new System.Drawing.Size(509, 150);
            this.dataGridView1.TabIndex = 31;
            // 
            // Qtdade
            // 
            this.Qtdade.HeaderText = "Qtdade";
            this.Qtdade.Name = "Qtdade";
            this.Qtdade.Width = 45;
            // 
            // Produto
            // 
            this.Produto.HeaderText = "Produto";
            this.Produto.Name = "Produto";
            this.Produto.Width = 350;
            // 
            // ValorTotalProduto
            // 
            this.ValorTotalProduto.HeaderText = "Valor Total Produto";
            this.ValorTotalProduto.Name = "ValorTotalProduto";
            this.ValorTotalProduto.Width = 70;
            // 
            // btAddProd
            // 
            this.btAddProd.Location = new System.Drawing.Point(411, 194);
            this.btAddProd.Name = "btAddProd";
            this.btAddProd.Size = new System.Drawing.Size(75, 36);
            this.btAddProd.TabIndex = 32;
            this.btAddProd.Text = "Adicionar Produto";
            this.btAddProd.UseVisualStyleBackColor = true;
            this.btAddProd.Click += new System.EventHandler(this.btAddProd_Click);
            // 
            // btRemProd
            // 
            this.btRemProd.Location = new System.Drawing.Point(492, 194);
            this.btRemProd.Name = "btRemProd";
            this.btRemProd.Size = new System.Drawing.Size(75, 36);
            this.btRemProd.TabIndex = 33;
            this.btRemProd.Text = "Remover Produto";
            this.btRemProd.UseVisualStyleBackColor = true;
            // 
            // cadVenda
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(661, 303);
            this.Controls.Add(this.btRemProd);
            this.Controls.Add(this.btAddProd);
            this.Controls.Add(this.dataGridView1);
            this.Controls.Add(this.tbValorPagar);
            this.Controls.Add(this.tbValorDesc);
            this.Controls.Add(this.tbValorTotal);
            this.Controls.Add(this.btLimparOS);
            this.Controls.Add(this.btSairOS);
            this.Controls.Add(this.btSalvarOS);
            this.Controls.Add(this.dtVenda);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label5);
            this.Name = "cadVenda";
            this.Text = "cadVenda";
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.DateTimePicker dtVenda;
        private System.Windows.Forms.Button btLimparOS;
        private System.Windows.Forms.Button btSairOS;
        private System.Windows.Forms.Button btSalvarOS;
        private System.Windows.Forms.TextBox tbValorTotal;
        private System.Windows.Forms.TextBox tbValorDesc;
        private System.Windows.Forms.TextBox tbValorPagar;
        private System.Windows.Forms.DataGridView dataGridView1;
        private System.Windows.Forms.DataGridViewTextBoxColumn Qtdade;
        private System.Windows.Forms.DataGridViewTextBoxColumn Produto;
        private System.Windows.Forms.DataGridViewTextBoxColumn ValorTotalProduto;
        private System.Windows.Forms.Button btAddProd;
        private System.Windows.Forms.Button btRemProd;
    }
}
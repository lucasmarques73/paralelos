namespace aula_30_09_Livraria
{
    partial class Livro
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
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.label7 = new System.Windows.Forms.Label();
            this.btFecharLivro = new System.Windows.Forms.Button();
            this.btApagarLivro = new System.Windows.Forms.Button();
            this.btSalvarLivro = new System.Windows.Forms.Button();
            this.label8 = new System.Windows.Forms.Label();
            this.tbCodLivro = new System.Windows.Forms.TextBox();
            this.tbISBNLivro = new System.Windows.Forms.TextBox();
            this.tbAnoLivro = new System.Windows.Forms.TextBox();
            this.tbEdicaoLivro = new System.Windows.Forms.TextBox();
            this.tbNomeLivro = new System.Windows.Forms.TextBox();
            this.tbAutoresLivros = new System.Windows.Forms.TextBox();
            this.comboBox1 = new System.Windows.Forms.ComboBox();
            this.comboBox2 = new System.Windows.Forms.ComboBox();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(12, 16);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(52, 16);
            this.label1.TabIndex = 10;
            this.label1.Text = "Código";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(12, 42);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(53, 16);
            this.label2.TabIndex = 11;
            this.label2.Text = "Gênero";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(12, 69);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(45, 16);
            this.label3.TabIndex = 12;
            this.label3.Text = "Nome";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(12, 95);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(32, 16);
            this.label4.TabIndex = 13;
            this.label4.Text = "Ano";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(273, 95);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(51, 16);
            this.label5.TabIndex = 14;
            this.label5.Text = "Edição";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label6.Location = new System.Drawing.Point(273, 42);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(51, 16);
            this.label6.TabIndex = 15;
            this.label6.Text = "Editora";
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label7.Location = new System.Drawing.Point(12, 123);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(54, 16);
            this.label7.TabIndex = 16;
            this.label7.Text = "Autores";
            // 
            // btFecharLivro
            // 
            this.btFecharLivro.Location = new System.Drawing.Point(480, 238);
            this.btFecharLivro.Name = "btFecharLivro";
            this.btFecharLivro.Size = new System.Drawing.Size(75, 23);
            this.btFecharLivro.TabIndex = 20;
            this.btFecharLivro.Text = "Fechar";
            this.btFecharLivro.UseVisualStyleBackColor = true;
            this.btFecharLivro.Click += new System.EventHandler(this.btFecharLivro_Click);
            // 
            // btApagarLivro
            // 
            this.btApagarLivro.Location = new System.Drawing.Point(399, 238);
            this.btApagarLivro.Name = "btApagarLivro";
            this.btApagarLivro.Size = new System.Drawing.Size(75, 23);
            this.btApagarLivro.TabIndex = 19;
            this.btApagarLivro.Text = "Apagar";
            this.btApagarLivro.UseVisualStyleBackColor = true;
            // 
            // btSalvarLivro
            // 
            this.btSalvarLivro.Location = new System.Drawing.Point(318, 238);
            this.btSalvarLivro.Name = "btSalvarLivro";
            this.btSalvarLivro.Size = new System.Drawing.Size(75, 23);
            this.btSalvarLivro.TabIndex = 18;
            this.btSalvarLivro.Text = "Salvar";
            this.btSalvarLivro.UseVisualStyleBackColor = true;
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label8.Location = new System.Drawing.Point(273, 16);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(39, 16);
            this.label8.TabIndex = 21;
            this.label8.Text = "ISBN";
            // 
            // tbCodLivro
            // 
            this.tbCodLivro.Location = new System.Drawing.Point(115, 15);
            this.tbCodLivro.Name = "tbCodLivro";
            this.tbCodLivro.Size = new System.Drawing.Size(100, 20);
            this.tbCodLivro.TabIndex = 22;
            // 
            // tbISBNLivro
            // 
            this.tbISBNLivro.Location = new System.Drawing.Point(374, 15);
            this.tbISBNLivro.Name = "tbISBNLivro";
            this.tbISBNLivro.Size = new System.Drawing.Size(100, 20);
            this.tbISBNLivro.TabIndex = 23;
            // 
            // tbAnoLivro
            // 
            this.tbAnoLivro.Location = new System.Drawing.Point(115, 94);
            this.tbAnoLivro.Name = "tbAnoLivro";
            this.tbAnoLivro.Size = new System.Drawing.Size(100, 20);
            this.tbAnoLivro.TabIndex = 24;
            // 
            // tbEdicaoLivro
            // 
            this.tbEdicaoLivro.Location = new System.Drawing.Point(374, 94);
            this.tbEdicaoLivro.Name = "tbEdicaoLivro";
            this.tbEdicaoLivro.Size = new System.Drawing.Size(100, 20);
            this.tbEdicaoLivro.TabIndex = 25;
            // 
            // tbNomeLivro
            // 
            this.tbNomeLivro.Location = new System.Drawing.Point(115, 68);
            this.tbNomeLivro.Name = "tbNomeLivro";
            this.tbNomeLivro.Size = new System.Drawing.Size(359, 20);
            this.tbNomeLivro.TabIndex = 26;
            // 
            // tbAutoresLivros
            // 
            this.tbAutoresLivros.Location = new System.Drawing.Point(115, 122);
            this.tbAutoresLivros.Multiline = true;
            this.tbAutoresLivros.Name = "tbAutoresLivros";
            this.tbAutoresLivros.Size = new System.Drawing.Size(359, 82);
            this.tbAutoresLivros.TabIndex = 27;
            // 
            // comboBox1
            // 
            this.comboBox1.FormattingEnabled = true;
            this.comboBox1.Location = new System.Drawing.Point(115, 41);
            this.comboBox1.Name = "comboBox1";
            this.comboBox1.Size = new System.Drawing.Size(121, 21);
            this.comboBox1.TabIndex = 28;
            // 
            // comboBox2
            // 
            this.comboBox2.FormattingEnabled = true;
            this.comboBox2.Location = new System.Drawing.Point(353, 41);
            this.comboBox2.Name = "comboBox2";
            this.comboBox2.Size = new System.Drawing.Size(121, 21);
            this.comboBox2.TabIndex = 29;
            // 
            // Livro
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(574, 273);
            this.Controls.Add(this.comboBox2);
            this.Controls.Add(this.comboBox1);
            this.Controls.Add(this.tbAutoresLivros);
            this.Controls.Add(this.tbNomeLivro);
            this.Controls.Add(this.tbEdicaoLivro);
            this.Controls.Add(this.tbAnoLivro);
            this.Controls.Add(this.tbISBNLivro);
            this.Controls.Add(this.tbCodLivro);
            this.Controls.Add(this.label8);
            this.Controls.Add(this.btFecharLivro);
            this.Controls.Add(this.btApagarLivro);
            this.Controls.Add(this.btSalvarLivro);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Livro";
            this.Text = "Livro";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Button btFecharLivro;
        private System.Windows.Forms.Button btApagarLivro;
        private System.Windows.Forms.Button btSalvarLivro;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.TextBox tbCodLivro;
        private System.Windows.Forms.TextBox tbISBNLivro;
        private System.Windows.Forms.TextBox tbAnoLivro;
        private System.Windows.Forms.TextBox tbEdicaoLivro;
        private System.Windows.Forms.TextBox tbNomeLivro;
        private System.Windows.Forms.TextBox tbAutoresLivros;
        private System.Windows.Forms.ComboBox comboBox1;
        private System.Windows.Forms.ComboBox comboBox2;
    }
}
namespace aula_30_09_Livraria
{
    partial class Editora
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
            this.tbCodEditora = new System.Windows.Forms.TextBox();
            this.tbNomeEditora = new System.Windows.Forms.TextBox();
            this.tbEndEditora = new System.Windows.Forms.TextBox();
            this.btSalvarEditora = new System.Windows.Forms.Button();
            this.btApagarEditora = new System.Windows.Forms.Button();
            this.btFecharEditora = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(12, 26);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(52, 16);
            this.label1.TabIndex = 0;
            this.label1.Text = "Código";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(12, 61);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(45, 16);
            this.label2.TabIndex = 1;
            this.label2.Text = "Nome";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(12, 97);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(67, 16);
            this.label3.TabIndex = 2;
            this.label3.Text = "Endereço";
            // 
            // tbCodEditora
            // 
            this.tbCodEditora.Location = new System.Drawing.Point(132, 26);
            this.tbCodEditora.Name = "tbCodEditora";
            this.tbCodEditora.Size = new System.Drawing.Size(100, 20);
            this.tbCodEditora.TabIndex = 3;
            // 
            // tbNomeEditora
            // 
            this.tbNomeEditora.Location = new System.Drawing.Point(132, 61);
            this.tbNomeEditora.Name = "tbNomeEditora";
            this.tbNomeEditora.Size = new System.Drawing.Size(305, 20);
            this.tbNomeEditora.TabIndex = 4;
            // 
            // tbEndEditora
            // 
            this.tbEndEditora.Location = new System.Drawing.Point(132, 97);
            this.tbEndEditora.Name = "tbEndEditora";
            this.tbEndEditora.Size = new System.Drawing.Size(305, 20);
            this.tbEndEditora.TabIndex = 5;
            // 
            // btSalvarEditora
            // 
            this.btSalvarEditora.Location = new System.Drawing.Point(200, 210);
            this.btSalvarEditora.Name = "btSalvarEditora";
            this.btSalvarEditora.Size = new System.Drawing.Size(75, 23);
            this.btSalvarEditora.TabIndex = 6;
            this.btSalvarEditora.Text = "Salvar";
            this.btSalvarEditora.UseVisualStyleBackColor = true;
            // 
            // btApagarEditora
            // 
            this.btApagarEditora.Location = new System.Drawing.Point(281, 210);
            this.btApagarEditora.Name = "btApagarEditora";
            this.btApagarEditora.Size = new System.Drawing.Size(75, 23);
            this.btApagarEditora.TabIndex = 7;
            this.btApagarEditora.Text = "Apagar";
            this.btApagarEditora.UseVisualStyleBackColor = true;
            // 
            // btFecharEditora
            // 
            this.btFecharEditora.Location = new System.Drawing.Point(362, 210);
            this.btFecharEditora.Name = "btFecharEditora";
            this.btFecharEditora.Size = new System.Drawing.Size(75, 23);
            this.btFecharEditora.TabIndex = 8;
            this.btFecharEditora.Text = "Fechar";
            this.btFecharEditora.UseVisualStyleBackColor = true;
            this.btFecharEditora.Click += new System.EventHandler(this.btFecharEditora_Click);
            // 
            // Editora
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(494, 245);
            this.Controls.Add(this.btFecharEditora);
            this.Controls.Add(this.btApagarEditora);
            this.Controls.Add(this.btSalvarEditora);
            this.Controls.Add(this.tbEndEditora);
            this.Controls.Add(this.tbNomeEditora);
            this.Controls.Add(this.tbCodEditora);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Editora";
            this.Text = "Editora";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbCodEditora;
        private System.Windows.Forms.TextBox tbNomeEditora;
        private System.Windows.Forms.TextBox tbEndEditora;
        private System.Windows.Forms.Button btSalvarEditora;
        private System.Windows.Forms.Button btApagarEditora;
        private System.Windows.Forms.Button btFecharEditora;
    }
}
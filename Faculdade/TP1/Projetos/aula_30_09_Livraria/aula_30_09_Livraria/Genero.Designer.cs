namespace aula_30_09_Livraria
{
    partial class Genero
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
            this.btFecharGenero = new System.Windows.Forms.Button();
            this.btApagarGenero = new System.Windows.Forms.Button();
            this.btSalvarGenero = new System.Windows.Forms.Button();
            this.tbDescGenero = new System.Windows.Forms.TextBox();
            this.tbNomeGenero = new System.Windows.Forms.TextBox();
            this.tbCodGenero = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // btFecharGenero
            // 
            this.btFecharGenero.Location = new System.Drawing.Point(376, 202);
            this.btFecharGenero.Name = "btFecharGenero";
            this.btFecharGenero.Size = new System.Drawing.Size(75, 23);
            this.btFecharGenero.TabIndex = 17;
            this.btFecharGenero.Text = "Fechar";
            this.btFecharGenero.UseVisualStyleBackColor = true;
            this.btFecharGenero.Click += new System.EventHandler(this.btFecharGenero_Click);
            // 
            // btApagarGenero
            // 
            this.btApagarGenero.Location = new System.Drawing.Point(295, 202);
            this.btApagarGenero.Name = "btApagarGenero";
            this.btApagarGenero.Size = new System.Drawing.Size(75, 23);
            this.btApagarGenero.TabIndex = 16;
            this.btApagarGenero.Text = "Apagar";
            this.btApagarGenero.UseVisualStyleBackColor = true;
            // 
            // btSalvarGenero
            // 
            this.btSalvarGenero.Location = new System.Drawing.Point(214, 202);
            this.btSalvarGenero.Name = "btSalvarGenero";
            this.btSalvarGenero.Size = new System.Drawing.Size(75, 23);
            this.btSalvarGenero.TabIndex = 15;
            this.btSalvarGenero.Text = "Salvar";
            this.btSalvarGenero.UseVisualStyleBackColor = true;
            // 
            // tbDescGenero
            // 
            this.tbDescGenero.Location = new System.Drawing.Point(146, 89);
            this.tbDescGenero.Multiline = true;
            this.tbDescGenero.Name = "tbDescGenero";
            this.tbDescGenero.Size = new System.Drawing.Size(305, 107);
            this.tbDescGenero.TabIndex = 14;
            // 
            // tbNomeGenero
            // 
            this.tbNomeGenero.Location = new System.Drawing.Point(146, 53);
            this.tbNomeGenero.Name = "tbNomeGenero";
            this.tbNomeGenero.Size = new System.Drawing.Size(305, 20);
            this.tbNomeGenero.TabIndex = 13;
            // 
            // tbCodGenero
            // 
            this.tbCodGenero.Location = new System.Drawing.Point(146, 18);
            this.tbCodGenero.Name = "tbCodGenero";
            this.tbCodGenero.Size = new System.Drawing.Size(100, 20);
            this.tbCodGenero.TabIndex = 12;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(26, 89);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(70, 16);
            this.label3.TabIndex = 11;
            this.label3.Text = "Descrição";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(26, 53);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(45, 16);
            this.label2.TabIndex = 10;
            this.label2.Text = "Nome";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(26, 18);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(52, 16);
            this.label1.TabIndex = 9;
            this.label1.Text = "Código";
            // 
            // Genero
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(477, 243);
            this.Controls.Add(this.btFecharGenero);
            this.Controls.Add(this.btApagarGenero);
            this.Controls.Add(this.btSalvarGenero);
            this.Controls.Add(this.tbDescGenero);
            this.Controls.Add(this.tbNomeGenero);
            this.Controls.Add(this.tbCodGenero);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Genero";
            this.Text = "Genero";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button btFecharGenero;
        private System.Windows.Forms.Button btApagarGenero;
        private System.Windows.Forms.Button btSalvarGenero;
        private System.Windows.Forms.TextBox tbDescGenero;
        private System.Windows.Forms.TextBox tbNomeGenero;
        private System.Windows.Forms.TextBox tbCodGenero;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;

    }
}